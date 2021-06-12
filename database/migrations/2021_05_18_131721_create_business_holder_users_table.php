<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessHolderUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_holder_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('business_name')->nullable();
            $table->string('owner_name')->nullable();
    
          
            $table->string('business_address')->nullable();
            $table->string('business_tin_no')->nullable();
            $table->string('owner_tin_no')->nullable();          
            $table->string('ownership_type')->nullable();
            $table->string('business_type')->nullable();
            $table->double('business_capital')->nullable();
            $table->string('last_license_issued')->nullable()->comment('Last Trade License Issue Year');
           
            
            // $table->text('capital_range');
            // $table->double('licence_fee');
            // $table->double('vat')->comment('vat 15% of licence fee');//15%
            // $table->double('business_tax');
            // $table->double('signboard_tax');
            // $table->double('service_charge');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_holder_users');
    }
}
