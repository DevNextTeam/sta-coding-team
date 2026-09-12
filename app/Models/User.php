<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password'])]
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
     * User subscription.
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
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
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_follows',
            'following_id',
            'follower_id'
        )->withTimestamps();
    }

    public function following(): BelongsToMany
    {
    return $this->belongsToMany(
        User::class,
        'user_follows',
        'follower_id',
        'following_id'
    )->withTimestamps();
    }
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