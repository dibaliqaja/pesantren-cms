<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyahriahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syahriahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->enum('month', ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
            $table->year('year');
            $table->enum('pay', ['1']);
            $table->uuid('santri_id')->nullable();
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
        Schema::dropIfExists('syahriahs');
    }
}
