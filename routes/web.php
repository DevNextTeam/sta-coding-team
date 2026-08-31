<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectResourceController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ProjectResourceController as AdminProjectResourceController;
use App\Http\Controllers\Admin\ProjectInstructionController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayMongoWebhookController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\ProfileController;


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


    // =================================================
    // SUBSCRIPTION CHECKOUT
    // =================================================

    Route::post(
        '/subscribe',
        [PaymentController::class, 'checkout']
    )
        ->name('subscription.checkout');


    // =================================================
    // PAYMENT SUCCESS
    // =================================================

    Route::get(
        '/payment/success',
        [PaymentController::class, 'success']
    )
        ->name('payment.success');


    // =================================================
    // PAYMENT CANCELLED
    // =================================================

    Route::get(
        '/payment/cancel',
        [PaymentController::class, 'cancel']
    )
        ->name('payment.cancel');


    // =================================================
    // VIEW SOURCE CODE
    // =================================================
    //
    // Opens the uploaded source-code/resource file
    // in the browser when the user has access.
    //

    Route::get(
        '/project-resources/{resource}/view',
        [ProjectResourceController::class, 'view']
    )
        ->middleware('subscription')
        ->name('project-resources.view');


    // =================================================
    // PREMIUM RESOURCE DOWNLOADS
    // =================================================

    Route::get(
        '/project-resources/{resource}/download',
        [ProjectResourceController::class, 'download']
    )
        ->middleware('subscription')
        ->name('project-resources.download');

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


        // =================================================
        // PAGE BUILDER
        // =================================================

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


        // =================================================
        // ADMIN DASHBOARD
        // =================================================

        Route::get(
            '/',
            [DashboardController::class, 'index']
        )
            ->name('dashboard');


        // =================================================
        // USER MANAGEMENT
        // =================================================

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


        // =================================================
        // ADMIN PROJECT MANAGEMENT
        // =================================================

        Route::resource(
            'projects',
            AdminProjectController::class
        );


        // =================================================
        // PROJECT RESOURCES
        // =================================================

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


        // =================================================
        // PROJECT INSTRUCTIONS
        // =================================================

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


// =====================================================
// PROFILE
// =====================================================

Route::post(
    '/profile/verify-password',
    [ProfileController::class, 'verifyPassword']
)
    ->middleware('auth')
    ->name('profile.verify-password');