<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('santri_number');
            $table->string('santri_name');
            $table->text('santri_address');
            $table->string('santri_birth_place');
            $table->date('santri_birth_date');
            $table->string('santri_phone');
            $table->string('santri_school_old');
            $table->text('santri_school_address_old');
            $table->string('santri_school_current');
            $table->text('santri_school_address_current');
            $table->string('santri_father_name');
            $table->string('santri_mother_name');
            $table->string('santri_father_job');
            $table->string('santri_mother_job');
            $table->string('santri_parent_phone');
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
        Schema::dropIfExists('santris');
    }
}
