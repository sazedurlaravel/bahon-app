<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Division;
use App\Models\Pourashava;
use App\Models\Zila;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // add super admin
        Admin::create( [
            'name'     => 'Super Admin',
            'email'    => 'super_admin@gmail.com',
            'mobile'   => '01700000000',
            'password' => Hash::make( 12345678 ),
        ] );

        // role permission seeder
        $this->call( RolePermissionSeeder::class );

        // Add Division
        Division::create( [
            'name' => 'ঢাকা',

        ] );

        // Add Zila
        Zila::create( [
            'division_id' => 1,
            'name'        => 'ঢাকা',

        ] );

        // Add Pourashava
        Pourashava::create( [
            'name'    => 'সাভার',
            'zila_id' => 1,

        ] );

    }
}
