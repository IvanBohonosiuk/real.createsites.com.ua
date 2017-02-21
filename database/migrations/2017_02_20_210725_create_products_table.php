<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default('0');
            $table->boolean('favorites')->default('0');
            $table->boolean('colored')->default('0');
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->integer('sale_price')->nullable();
            $table->integer('qty')->default('1');
            $table->string('img')->default('product.jpg');
            $table->text('images')->nullable();
            $table->text('files')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
