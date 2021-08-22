<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_mails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('mail_number');
            $table->date('mail_date');
            $table->text('note');
            $table->string('sender');
            $table->string('recipient');
            $table->date('record_date');
            $table->string('file_in')->nullable();
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
        Schema::dropIfExists('in_mails');
    }
}
