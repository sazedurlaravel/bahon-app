<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\Settings\ZilaController;
use App\Http\Controllers\Admin\PourashavaAdminController;
use App\Http\Controllers\Admin\Settings\VillageController;
use App\Http\Controllers\Admin\Settings\DivisionController;
use App\Http\Controllers\Admin\BusinessHolderUserController;
use App\Http\Controllers\Admin\DigitalCenterAdminController;
use App\Http\Controllers\Admin\Settings\PourashavaController;
use App\Http\Controllers\Admin\Settings\WardNumberController;
use App\Http\Controllers\Admin\Settings\VehicleTypeController;
use App\Http\Controllers\Admin\PourashavaAdminWalletController;
use App\Http\Controllers\Admin\Settings\BusinessTypeController;
use App\Http\Controllers\Admin\Settings\CapitalRangeController;
use App\Http\Controllers\Admin\Settings\OwnershipTypeController;
use App\Http\Controllers\PourashavaFrontend\MainMayorController;
use App\Http\Controllers\PourashavaFrontend\PourashavaInformationController;

/**
 * Routes after authenticate
 */
Route::middleware( ['auth:admin', 'is_expired'] )->name( 'admin.' )->prefix( 'admin' )->group( function () {

    /**
     * super admin route
     */
    Route::get( '/', [HomeController::class, 'index'] )->name( 'home' );

    Route::get( '/wallet', [WalletController::class, 'index'] )->name( 'wallet' );

    Route::middleware( 'role:super_admin' )->group( function () {
        // pourashava_admins routes
        Route::get( 'pourashava_admins/deactive', [PourashavaAdminController::class, 'deactive'] )->name( 'pourashava_admins.deactive' );
        Route::resource( 'pourashava_admins', PourashavaAdminController::class )->except( ['destroy'] );
       //Wallet routes
        Route::resource( 'wallets', WalletController::class )->except( ['create', 'edit','show', 'destroy'] );
        Route::get( 'wallets/approve/{id}', [WalletController::class, 'approve'] )->name( 'wallets.approve' );

        //frontend information route
        Route::resource( 'information', InformationController::class );

        // settings route
        Route::prefix( 'settings' )->name( 'settings.' )->group( function () {
            Route::resource( 'divisions', DivisionController::class )->except( ['create', 'edit', 'show'] );
            Route::resource( 'zilas', ZilaController::class )->except( ['create', 'edit', 'show'] );
            Route::resource( 'pourashavas', PourashavaController::class )->except( ['create', 'edit', 'show'] );
        } );
    } );

    Route::middleware( 'role:pourashava_admin' )->group( function () {
        // digital center routes
        Route::resource( 'digital_center_admins', DigitalCenterAdminController::class )->except( ['destroy'] );
        // e-wallet routes
        Route::resource( 'pourashava_admin_wallets', PourashavaAdminWalletController::class )->except( ['create', 'edit', 'show'] );
        Route::get( 'pourashava_admin_wallet/transaction/history',[PourashavaAdminWalletController::class, 'transactionHistory'])->name('wallet.transaction');
        Route::get( 'pourashava_admin_wallets/request', [PourashavaAdminWalletController::class, 'get_wallet_request'] )->name( 'pourashava_admin_wallets.get_request' );
        Route::get( 'pourashava_admin_wallets/approve/{id}', [PourashavaAdminWalletController::class, 'approve'] )->name( 'pourashava_admin_wallets.approve' );


        // settings
        Route::prefix('settings')->name('settings.')->group(function() {
            // pourashava ward
            Route::resource("wardnumbers", WardNumberController::class )->except(['create','show', 'destroy']);
            //pourashava village
            Route::resource("villages", VillageController::class)->except(['create','show', 'destroy']);
           
            Route::resource("ownerships", OwnershipTypeController::class)->except(['create','show', 'destroy']);
            Route::resource("business_types", BusinessTypeController::class)->except(['destroy']);
           
            Route::resource("capital_ranges", CapitalRangeController::class)->except(['destroy']);

            Route::resource('vehicle_types', VehicleTypeController::class)->except(['show', 'destroy']);

            //pourashava information set up
            Route::resource("pourashava_information",PourashavaInformationController::class )->except(['show', 'destroy']);;
            //main mayor
            Route::resource("main_mayor",MainMayorController::class );

        });
    });
    Route::middleware( 'role:super_admin|pourashava_admin')->group( function () {
      // business holder user routes
        Route::resource( 'business_holders', BusinessHolderUserController::class )->except( ['destroy'] );;
    });


    // user routes
    Route::get( 'users/deactive', [UserController::class, 'deactive'] )->name( 'users.deactive' );
    Route::get( 'users/{user}/card', [UserController::class, 'card'] )->name( 'users.card' );
    Route::resource( 'users', UserController::class )->except( ['destroy'] );

} );
