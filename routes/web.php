<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectResourceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectLikeController;
use App\Http\Controllers\ProjectSaveController;

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ProjectResourceController as AdminProjectResourceController;
use App\Http\Controllers\Admin\ProjectInstructionController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayMongoWebhookController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Developer\ProjectController as DeveloperProjectController;
use App\Http\Controllers\Developer\ProjectResourceController as DeveloperProjectResourceController;
use App\Http\Controllers\Developer\ProjectInstructionController as DeveloperProjectInstructionController;
use App\Http\Controllers\SavedProjectController;
use App\Http\Controllers\ProjectCommentController;
use App\Http\Controllers\UserFollowController;


/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/


// =====================================================
// HOME
// =====================================================

Route::get('/', [HomeController::class, 'home']);


// =====================================================
// ABOUT PAGE
// =====================================================
//
// IMPORTANT:
// The public About page is loaded from the Page Builder
// database record with slug = "about".
//

Route::get('/about', function () {

    return app(PageController::class)->show('about');

});


// =====================================================
// CONTACT PAGE
// =====================================================
//
// IMPORTANT:
// The public Contact page is loaded from the Page Builder
// database record with slug = "contact".
//

Route::get('/contact', function () {

    return app(PageController::class)->show('contact');

});


// =====================================================
// CONTACT FORM SUBMISSION
// =====================================================

Route::post(
    '/contact',
    [ContactController::class, 'store']
);


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})
    ->middleware('auth')
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| PUBLIC PROJECTS
|--------------------------------------------------------------------------
*/

Route::get(
    '/projects',
    [ProjectController::class, 'index']
)
    ->name('projects.index');


Route::get(
    '/projects/{project}',
    [ProjectController::class, 'show']
)
    ->name('projects.show');


/*
|--------------------------------------------------------------------------
| PAYMONGO WEBHOOK
|--------------------------------------------------------------------------
*/

Route::post(
    '/paymongo/webhook',
    [PayMongoWebhookController::class, 'handle']
)
    ->name('paymongo.webhook');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DEVELOPER STUDIO
    |--------------------------------------------------------------------------
    |
    | These routes are protected by both:
    |
    | auth      -> User must be logged in
    | not.admin -> User must NOT be an administrator
    |
    | Normal users can access Developer Studio.
    | Admin users receive a 403 Forbidden response.
    |
    */

    Route::middleware('not.admin')->group(function () {


        // =================================================
        // DEVELOPER PROJECTS
        // =================================================

        Route::get(
            '/dashboard/projects',
            [DeveloperProjectController::class, 'index']
        )
            ->name('developer.projects.index');


        Route::get(
            '/dashboard/projects/create',
            [DeveloperProjectController::class, 'create']
        )
            ->name('developer.projects.create');


        Route::post(
            '/dashboard/projects',
            [DeveloperProjectController::class, 'store']
        )
            ->name('developer.projects.store');


        Route::get(
            '/dashboard/projects/{project}/edit',
            [DeveloperProjectController::class, 'edit']
        )
            ->name('developer.projects.edit');


        Route::put(
            '/dashboard/projects/{project}',
            [DeveloperProjectController::class, 'update']
        )
            ->name('developer.projects.update');


        Route::delete(
            '/dashboard/projects/{project}',
            [DeveloperProjectController::class, 'destroy']
        )
            ->name('developer.projects.destroy');


        // =================================================
        // DEVELOPER PROJECT RESOURCES
        // =================================================

        Route::post(
            '/dashboard/projects/{project}/resources',
            [DeveloperProjectResourceController::class, 'store']
        )
            ->name('developer.projects.resources.store');


        Route::delete(
            '/dashboard/projects/resources/{resource}',
            [DeveloperProjectResourceController::class, 'destroy']
        )
            ->name('developer.projects.resources.destroy');


        // =================================================
        // DEVELOPER PROJECT INSTRUCTIONS
        // =================================================

        Route::post(
            '/dashboard/projects/{project}/instructions',
            [DeveloperProjectInstructionController::class, 'store']
        )
            ->name('developer.projects.instructions.store');


        Route::put(
            '/dashboard/projects/instructions/{instruction}',
            [DeveloperProjectInstructionController::class, 'update']
        )
            ->name('developer.projects.instructions.update');


        Route::delete(
            '/dashboard/projects/instructions/{instruction}',
            [DeveloperProjectInstructionController::class, 'destroy']
        )
            ->name('developer.projects.instructions.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | DEVELOPER PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard/profile/edit',
        [ProfileController::class, 'edit']
    )
        ->name('profile.edit');


    Route::put(
        '/dashboard/profile',
        [ProfileController::class, 'update']
    )
        ->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | SUBSCRIPTION CHECKOUT
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/subscribe',
        [PaymentController::class, 'checkout']
    )
        ->name('subscription.checkout');


    /*
    |--------------------------------------------------------------------------
    | PAYMENT SUCCESS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/payment/success',
        [PaymentController::class, 'success']
    )
        ->name('payment.success');


    /*
    |--------------------------------------------------------------------------
    | PAYMENT CANCELLED
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/payment/cancel',
        [PaymentController::class, 'cancel']
    )
        ->name('payment.cancel');


    /*
    |--------------------------------------------------------------------------
    | VIEW SOURCE CODE
    |--------------------------------------------------------------------------
    |
    | Opens the uploaded source-code/resource file
    | in the browser when the user has access.
    |
    */

    Route::get(
        '/project-resources/{resource}/view',
        [ProjectResourceController::class, 'view']
    )
        ->middleware('subscription')
        ->name('project-resources.view');


    /*
    |--------------------------------------------------------------------------
    | PREMIUM RESOURCE DOWNLOADS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/project-resources/{resource}/download',
        [ProjectResourceController::class, 'download']
    )
        ->middleware('subscription')
        ->name('project-resources.download');


    Route::post('/projects/{project}/like', [ProjectLikeController::class, 'store'])
    ->name('projects.like');

    Route::delete('/projects/{project}/like', [ProjectLikeController::class, 'destroy'])
    ->name('projects.unlike');

    Route::post('/projects/{project}/save', [ProjectSaveController::class, 'store'])
    ->name('projects.save');

Route::delete('/projects/{project}/save', [ProjectSaveController::class, 'destroy'])
    ->name('projects.unsave');
    Route::get('/dashboard/saved-projects', [SavedProjectController::class, 'index'])
    ->name('saved-projects.index');
    Route::post('/projects/{project}/comments', [ProjectCommentController::class, 'store'])
    ->name('projects.comments.store');

Route::put('/comments/{comment}', [ProjectCommentController::class, 'update'])
    ->name('projects.comments.update');

Route::delete('/comments/{comment}', [ProjectCommentController::class, 'destroy'])
    ->name('projects.comments.destroy');
    Route::post('/users/{user}/follow', [UserFollowController::class, 'store'])
    ->name('users.follow');

Route::delete('/users/{user}/follow', [UserFollowController::class, 'destroy'])
    ->name('users.unfollow');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | PAGE BUILDER
        |--------------------------------------------------------------------------
        */

        Route::get(
            'pages/{slug}/edit',
            [\App\Http\Controllers\Admin\PageBuilderController::class, 'edit']
        )
            ->name('pages.edit');


        Route::put(
            'pages/{slug}',
            [\App\Http\Controllers\Admin\PageBuilderController::class, 'update']
        )
            ->name('pages.update');


        /*
        |--------------------------------------------------------------------------
        | ADMIN DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/',
            [DashboardController::class, 'index']
        )
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::get(
            'users',
            [AdminUserController::class, 'index']
        )
            ->name('users.index');


        Route::post(
            'users/{user}/activate',
            [AdminUserController::class, 'activate']
        )
            ->name('users.activate');


        Route::post(
            'users/{user}/extend',
            [AdminUserController::class, 'extend']
        )
            ->name('users.extend');


        Route::post(
            'users/{user}/expire',
            [AdminUserController::class, 'expire']
        )
            ->name('users.expire');


        /*
        |--------------------------------------------------------------------------
        | ADMIN PROJECT MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'projects',
            AdminProjectController::class
        );


        /*
        |--------------------------------------------------------------------------
        | PROJECT RESOURCES
        |--------------------------------------------------------------------------
        */

        Route::post(
            'projects/{project}/resources',
            [AdminProjectResourceController::class, 'store']
        )
            ->name('projects.resources.store');


        Route::delete(
            'projects/resources/{resource}',
            [AdminProjectResourceController::class, 'destroy']
        )
            ->name('projects.resources.destroy');


        /*
        |--------------------------------------------------------------------------
        | PROJECT INSTRUCTIONS
        |--------------------------------------------------------------------------
        */

        Route::post(
            'projects/{project}/instructions',
            [ProjectInstructionController::class, 'store']
        )
            ->name('projects.instructions.store');


        Route::put(
            'projects/instructions/{instruction}',
            [ProjectInstructionController::class, 'update']
        )
            ->name('projects.instructions.update');


        Route::delete(
            'projects/instructions/{instruction}',
            [ProjectInstructionController::class, 'destroy']
        )
            ->name('projects.instructions.destroy');

    });


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::post(
    '/profile/verify-password',
    [ProfileController::class, 'verifyPassword']
)
    ->middleware('auth')
    ->name('profile.verify-password');


Route::get(
    '/u/{username}',
    [ProfileController::class, 'show']
)
    ->name('profile.show');