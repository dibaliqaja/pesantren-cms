<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_costs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('construction');
            $table->float('facilities');
            $table->float('wardrobe');
            $table->uuid('santri_id');
            $table->timestamps();

            $table->foreign('santri_id')
                ->references('id')
                ->on('santris')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_costs');
    }
}
