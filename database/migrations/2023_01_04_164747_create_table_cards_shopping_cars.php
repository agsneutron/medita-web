<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCardsShoppingCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('audio_id')->constrained('audios');
            $table->timestamps();
        });
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name_client');
            $table->string('num_target');
            $table->date('expired_date');
            $table->foreignId('client_id')->constrained('clients');
            $table->timestamps();
        });
        Schema::table('client_audio', function (Blueprint $table) {
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
        Schema::table('client_audio', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
        Schema::dropIfExists('cards');
        Schema::dropIfExists('shopping_cars');
    }
}
