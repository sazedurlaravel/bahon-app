<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('pourashava_admin_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types');
            $table->unsignedBigInteger('registration_no')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->integer('card_no')->unique();
            $table->integer('pin_no');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('picture')->nullable();
            $table->string('father_or_husband_name');
            $table->string('mother_name');
            $table->unsignedInteger('age');
            $table->date('birth_day');
            $table->unsignedBigInteger('nid_no');
            $table->string('village');
            $table->unsignedInteger('word_no');
            $table->foreignId('pourashava_id')->constrained('pourashavas')->cascadeOnDelete();
            $table->unsignedInteger('post_code');
            $table->string('permanent_address');
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
        Schema::dropIfExists('users');
    }
}
