<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('admins')->cascadeOnDelete();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('picture')->nullable();
            $table->foreignId('pourashava_id')->nullable()->constrained('pourashavas')->cascadeOnDelete();
            $table->string('division_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('pourashava_name')->nullable();
            $table->string('pourashava_logo')->nullable();
            $table->string('pourashava_url')->nullable()->unique();
            $table->unsignedInteger('post_code')->nullable();
            $table->unsignedInteger('admin_account_renew_fee')->nullable();
            $table->unsignedInteger('user_registration_fee')->nullable();
            $table->unsignedInteger('user_account_renew_fee')->nullable();
            $table->timestamp('valid_to')->nullable()->comment('account validation end date');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
