<?php

use App\Http\Controllers\RegisteredAdminController;
use App\Http\Controllers\AuthCheckController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

// ADMIN ROUTES

Route::prefix('admin')->name('admin.')->group(function () {
    $limiter = config('fortify.limiters.login');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest:admin')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:admin',
            $limiter ? 'throttle:' . $limiter : null,
        ]));

    Route::get('/register', [RegisteredAdminController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredAdminController::class, 'store']);
});

// CUSTOMER ROUTES

$limiter = config('fortify.limiters.login');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware(['guest:customer'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:customer',
        $limiter ? 'throttle:' . $limiter : null,
    ]));

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

// COMMON USED ROUTES

Route::get('/auth/customer', [AuthCheckController::class, 'customer']);

Route::get('/auth/admin', [AuthCheckController::class, 'admin']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::put('/user/password', [PasswordController::class, 'update'])
    ->middleware(['auth:admin, customer'])
    ->name('user-password.update');

Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
    ->middleware(['auth:admin,customer'])
    ->name('user-profile-information.update');

Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware(['auth:admin,customer'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth:admin,customer', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth:admin,customer', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest:admin,customer')
    ->name('password.request');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest:admin,customer')
    ->name('password.reset');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest:admin,customer')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest:admin,customer')
    ->name('password.update');
