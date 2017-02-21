<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->boolean('active')->default('0');
            $table->timestamp('end_date')->nullable();
            $table->integer('price')->nullable();
            $table->string('image')->nullable();
            $table->string('files')->nullable();
            $table->boolean('remote')->default('0');
            $table->string('status')->default('Open');
            $table->integer('user_id')->default('1');
            $table->integer('freelancer_id')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
