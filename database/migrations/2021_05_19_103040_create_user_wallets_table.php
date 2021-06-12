<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();//Who are requesting for wallet money
            $table->foreignId('admin_id')->nullable()->constrained('admins')->cascadeOnDelete();//The Poura Admin Who approved wallet money
            $table->foreignId('pourashava_id')->nullable()->constrained('pourashavas')->cascadeOnDelete();//The Poura Admin Who approved wallet money
            $table->double('amount')->default(0);
            $table->dateTime('date')->nullable();
            $table->integer('status')->default(0);
           
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
        Schema::dropIfExists('user_wallets');
    }
}