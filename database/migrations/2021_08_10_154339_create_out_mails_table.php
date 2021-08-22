<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_mails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('mail_number');
            $table->date('mail_date');
            $table->text('note');
            $table->string('sender');
            $table->string('recipient');
            $table->date('record_date');
            $table->string('file_out')->nullable();
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
        Schema::dropIfExists('out_mails');
    }
}
