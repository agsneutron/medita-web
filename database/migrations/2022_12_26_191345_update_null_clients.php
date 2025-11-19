<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table){
           $table->foreignId('institution_id')->nullable(true)->change();
           $table->foreignId('educational_level_id')->nullable(true)->change();
           $table->integer('degree')->nullable(true)->change();
           $table->boolean('teacher')->nullable(true)->change();
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
