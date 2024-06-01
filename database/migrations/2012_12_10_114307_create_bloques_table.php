<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBloquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloques', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('estado_b');
            $table->timestamps();


        });
        DB::table('bloques')->insert([
            ['nombre' => 'BLOQUE CERO','estado_b'=> 1 ],
            ['nombre' => 'BLOQUE ACADEMICO','estado_b'=> 1 ],
            ['nombre' => 'BLOQUE CIERRE','estado_b'=> 1 ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bloques');
    }
}
