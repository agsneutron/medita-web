<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvaluationsAndAudiosTableAdjustments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('audios', function (Blueprint $table){
//            > Agregar campo 'url_gif'
//            > Agergar campo 'duration'
            $table->string('url_gif')->after('url_audio');
            $table->string('duration')->after('name');
        });

        Schema::table('evaluations', function (Blueprint $table){
//            > Cambiar campo 'date' a 'score'
//            > Agregar campo 'audio_id'
            $table->dropColumn('date');
            $table->float('score',4,1)->after('id');
            $table->foreignId('audio_id')->constrained('audios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
