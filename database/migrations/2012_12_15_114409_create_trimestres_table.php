<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTrimestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimestres', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('estado_t');

            $table->timestamps();
        });
        DB::table('trimestres')->insert([
            ['descripcion' => 'PRIMER TRIMESTRE','estado_t'=> 1],
            ['descripcion' => 'SEGUNDO TRIMESTRE','estado_t'=> 1],
            ['descripcion' => 'TERCER TRIMESTRE','estado_t'=> 1 ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trimestres');
    }
}
