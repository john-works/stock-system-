<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('product_id'); // Foreign key
        $table->unsignedBigInteger('supplier_id'); // Foreign key
            $table->integer('qty');
            $table->string('unit');
            $table->string('original_price');
            $table->string('selling_price');
            
    
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

             
    
             $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
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
        Schema::dropIfExists('purchases');
    }
}
