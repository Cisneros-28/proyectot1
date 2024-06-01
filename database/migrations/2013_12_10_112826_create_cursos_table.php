<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {

                $table->id();
                $table->string('nombre_curso');
                $table->integer('estado_curso')->default(0);

                $table->timestamps();
            });
            DB::table('cursos')->insert([
                ['nombre_curso' => 'TODOS','estado_curso'=> 1],
                ['nombre_curso' => 'SEXTO A','estado_curso'=> 1],

            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
