<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\PourashavaFrontend\HomeController;
use App\Http\Controllers\PourashavaFrontend\LoginController;
use Illuminate\Support\Facades\Route;

Route::get( '/', [FrontendController::class, "index"] )->name( 'frontend.home' );

Route::prefix('{pourashava_slug}')->name('pourashava_frontend.')->group(function() {
    Route::get('/', [HomeController::class, "index"])->name('home');
    Route::get('/test', [HomeController::class, "test"])->name('test');

    Route::middleware('guest:service_user')->name('user.')->prefix('user')->group(function() {
        Route::get('/login', [LoginController::class, "login"])->name('login');
        Route::post('/login', [LoginController::class, "store"])->name('login.store');
        Route::get('login/otp', [LoginController::class, "loginOtp"])->name('login.otp');
        Route::post('login/otp/check', [LoginController::class, "otpCheck"])->name('login.otp.check');
    });
    
    Route::middleware('auth:service_user')->name('user.')->prefix('user')->group(function() {
        Route::get('/', [HomeController::class, "dashboard"])->name('home');
        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

        // e-wallet for service user
        Route::get( '/wallet', [HomeController::class, "userWallet"] )->name( 'wallet' );
        Route::get( '/wallet/transaction', [HomeController::class, "transactionHistory"] )->name( 'wallet.transaction' );
        Route::post( 'wallet/request', [HomeController::class, 'walletRequest'] )->name( 'wallet.request' );
        Route::put( 'wallet/update/{id}', [HomeController::class, 'walletUpdate'] )->name( 'wallet.update' );
    });
});
