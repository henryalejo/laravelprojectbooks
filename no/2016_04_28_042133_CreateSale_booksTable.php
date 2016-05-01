<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_books', function (Blueprint $table) {
            $table->integer('sale_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sale_books');
    }
}
