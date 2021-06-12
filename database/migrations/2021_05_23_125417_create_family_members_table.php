<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->integer('holding_no');
            $table->unsignedBigInteger('ward_id');
            $table->unsignedBigInteger('village_id');
            $table->string('post_office_name');
            $table->integer('post_code');
            $table->string('religion');
            $table->string('gender');
            $table->string('metterial_status');
            $table->string('name');
            $table->string('father_or_husband_name');
            $table->string('mother_name');
            $table->date('date_of_birth');
            $table->integer('nid_no');
            $table->string('mobile');
            $table->string('occasion');
            $table->integer('monthly_income');
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
        Schema::dropIfExists('family_members');
    }
}
