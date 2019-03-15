<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('opcao');
            $table->integer('quantidade')->default(0);
            $table->bigInteger('tema_id')->unsigned();
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->softDeletes();
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
        Schema::dropIfExists('opcaos');
    }
}
