<?php

namespace App\Models;

use App\Notifications\DevNextResetPassword;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Send the custom DevNext password reset notification.
     *
     * Fortify supplies the secure password reset token.
     * DevNext generates a separate 6-digit verification code.
     */
    public function sendPasswordResetNotification($token): void
    {
        $code = (string) random_int(100000, 999999);

        /*
         * Remove any previous reset codes for this email.
         */
        PasswordResetCode::where('email', $this->getEmailForPasswordReset())
            ->delete();

        /*
         * Store the code as a hash.
         *
         * The actual 6-digit code is never stored
         * directly in the database.
         */
        PasswordResetCode::create([
            'email' => $this->getEmailForPasswordReset(),
            'code' => Hash::make($code),
            'expires_at' => now()->addMinutes(10),
        ]);

        /*
         * Send the custom DevNext email.
         */
        $this->notify(
            new DevNextResetPassword($token, $code)
        );
    }

    /**
     * User subscription.
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    /**
     * Determine whether the user has premium access.
     *
     * Admin and Developer have permanent access.
     * Regular users need an active subscription.
     */
    public function hasPremiumAccess(): bool
    {
        if (in_array($this->role, ['admin', 'developer'])) {
            return true;
        }

        return $this->subscription?->isActive() ?? false;
    }

    /**
     * User developer profile.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * User projects.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Projects liked by the user.
     */
    public function likedProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_likes')
            ->withTimestamps();
    }

    /**
     * Projects saved by the user.
     */
    public function savedProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_saves')
            ->withTimestamps();
    }

    /**
     * Projects comments by the user.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ProjectComment::class);
    }

    /**
     * Users following this user.
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_follows',
            'following_id',
            'follower_id'
        )->withTimestamps();
    }

    /**
     * Users this user is following.
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_follows',
            'follower_id',
            'following_id'
        )->withTimestamps();
    }

    /**
     * User social accounts.
     */
    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * Queue a Google profile synchronization when needed.
     */
    public function queueGoogleProfileSync(): void
    {
        $googleAccount = $this->socialAccounts()
            ->where('provider', 'google')
            ->first();

        if (!$googleAccount) {
            return;
        }

        /*
         * Don't queue another job if the profile was
         * synchronized within the last 24 hours.
         */
        if (
            $googleAccount->profile_synced_at &&
            $googleAccount->profile_synced_at->gt(now()->subDay())
        ) {
            return;
        }

        \App\Jobs\SyncGoogleProfile::dispatch(
            $googleAccount->id
        );
    }
}
