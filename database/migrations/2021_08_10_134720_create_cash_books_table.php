<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->text('note');
            $table->decimal('debit', 13, 2)->default(0);
            $table->decimal('credit', 13, 2)->default(0);
            $table->uuid('registration_cost_id')->nullable();
            $table->uuid('syahriah_id')->nullable();
            $table->timestamps();

            $table->foreign('registration_cost_id')
                ->references('id')
                ->on('registration_costs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('syahriah_id')
                ->references('id')
                ->on('syahriahs')
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
        Schema::dropIfExists('cash_books');
    }
}
