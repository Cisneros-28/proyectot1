<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleBloquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_bloques', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion',10000)->nullable(true);
            $table->string('archivo')->nullable(true);
            $table->string('imagen')->nullable(true);
            $table->string('video')->nullable(true);
            $table->integer('estado');

            $table->unsignedBigInteger('id_tema')->nullable();
            $table->foreign('id_tema')->references('id')->on('temas')->onDelete('cascade');

            $table->unsignedBigInteger('id_bloque');
            $table->foreign('id_bloque')->references('id')->on('bloques')->onDelete('cascade');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_recurso');
            $table->foreign('id_recurso')->references('id')->on('recursos')->onDelete('cascade');

            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');

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
        Schema::dropIfExists('detalle_bloques');
    }
}
