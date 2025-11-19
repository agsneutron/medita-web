<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAudioPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audios', function (Blueprint $table){
//            > Agregar campo 'price'
            $table->float('price')->nullable(false)->after('name');
        });

        Schema::table('cards', function (Blueprint $table){
//            > Agregar campo 'stripe_id'
            $table->string('stripe_id')->after('expired_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audios', function (Blueprint $table) {
            $table->dropColumn('price');
        });
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('stripe_id');
        });
    }
}
