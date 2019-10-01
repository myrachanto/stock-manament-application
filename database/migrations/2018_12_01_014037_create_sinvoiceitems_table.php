<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinvoiceitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinvoiceitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();            
            $table->integer('sinvoice_id')->unsigned();
            $table->string('description');
            $table->integer('qty');
            $table->decimal('unit_price');
            $table->decimal('vat')->default(0);
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
        Schema::dropIfExists('sinvoiceitems');
    }
}
