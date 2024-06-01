<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('detalle_tema');
            $table->string('recurso')->nullable(true);
            $table->string('curso');
            $table->integer('estado_tema');

            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_materia')->references('id')->on('materias')->onDelete('cascade');

            $table->unsignedBigInteger('id_bloque');
            $table->foreign('id_bloque')->references('id')->on('bloques')->onDelete('cascade');

            $table->integer('id_user');

            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');


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
        Schema::dropIfExists('temas');
    }
}
