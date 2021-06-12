<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_guardians', function (Blueprint $table) {
            $table->id();
            $table->Integer('family_member_id');
            $table->unsignedInteger('holding_no');
            $table->unsignedBigInteger('ward_id');
            $table->unsignedBigInteger('village_id');
            $table->integer('post_office_name');
            $table->integer('post_code');
            $table->integer('religion');
            $table->integer('gender');
            $table->integer('metterial_status');
            $table->integer('name');
            $table->integer('father_or_husband_name');
            $table->integer('mother_name');
            $table->date('date_of_birth');
            $table->unsignedBigInteger('nid_no');
            $table->integer('mobile');
            $table->integer('house_type');
            $table->integer('room_amount');
            $table->integer('house_annual_value');
            $table->integer('occasion');
            $table->integer('monthly_income');
            $table->integer('last_tax_pay_year');
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
        Schema::dropIfExists('family_guardians');
    }
}
