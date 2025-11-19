<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTables extends Migration
{

    protected const
        HISTORY = 'history',
        CLIENT_AUDIO = 'client_audio';

    protected const
        AUDIO_ID = 'audios_id',
        CLIENT_ID = 'client_id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        self::createHistoryTable(self::HISTORY);
        self::createClientAudioTable(self::CLIENT_AUDIO);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables =
            [
                self::HISTORY,
                self::CLIENT_AUDIO
            ];
        self::dropIfExistCustom($tables);
    }

    private static function dropIfExistCustom($tables)
    {
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }

    /**
     * @property Table history
     */
    protected static function createHistoryTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId(self::CLIENT_ID)->constrained();
            $table->foreignId(self::AUDIO_ID)->constrained();
            $table->integer('progress');
            $table->timestamps();
        });
    }

    /**
     * @property Table client_audio
     */
    protected static function createClientAudioTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId(self::CLIENT_ID)->constrained();
            $table->foreignId(self::AUDIO_ID)->constrained();
            $table->boolean('completed')->default(false);
        });
    }

}
