<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessHolderCapitalRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_holder_capital_ranges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_holder_user_id')->constrained('business_holder_users')->cascadeOnDelete();
            $table->foreignId('capital_range_id')->constrained('capital_ranges')->cascadeOnDelete();
            $table->integer('vat')->comment('Vat 15% of Licence Fee');

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
        Schema::dropIfExists('business_holder_capital_ranges');
    }
}
