<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricePhases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phases', function (Blueprint $table) {
            $table->float('price')->nullable();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('duration')->nullable();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('phase_id')->nullable()->constrained();
            $table->dropForeign(['audios_id']);
            $table->foreignId('audios_id')->nullable()->change()->constrained();
        });
        Schema::table('shopping_cars', function (Blueprint $table) {
            $table->foreignId('phase_id')->nullable()->constrained();
            $table->dropForeign(['audio_id']);
            $table->foreignId('audio_id')->nullable()->change()->constrained('audios');
        });
        Schema::create('client_phase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('phase_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phases', function (Blueprint $table) {
            $table->dropColumn('price');
        });Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['phase_id']);
            $table->dropColumn('phase_id');
        });
        Schema::table('shopping_cars', function (Blueprint $table) {
            $table->dropForeign(['phase_id']);
            $table->dropColumn('phase_id');
        });
        Schema::dropIfExists('client_phase');
    }
}
