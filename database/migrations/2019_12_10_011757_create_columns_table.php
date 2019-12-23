<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('columns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('faked')->default(true);
            $table->string('value');
            $table->boolean('is_function')->default(true);
            $table->json('options')->nullable();
            $table->unsignedBigInteger('table_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('columns');
        Schema::dropIfExists('tables');
    }
}
