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
            $table->string('name');
            $table->text('address');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('phone');
            $table->string('school_old');
            $table->text('school_address_old');
            $table->string('school_current');
            $table->text('school_address_current');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('father_job');
            $table->string('mother_job');
            $table->string('parent_phone');
            $table->year('entry_year');
            $table->year('year_out')->nullable();
            $table->string('photo')->nullable();
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
