<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssiginingRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigining_room_types', function (Blueprint $table) {
            $table->id();
            $table->string('room_type');
            $table->string('use_type');
            $table->integer('monthly_rent_rat');
            $table->integer('yearly_value');
            $table->integer('yearly_tax');
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
        Schema::dropIfExists('assigining_room_types');
    }
}
