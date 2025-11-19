<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhaseUrlManual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phases', function (Blueprint $table){
            $table->string('url_manual')->nullable()->after('url_image');
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
            $table->dropColumn('url_manual');
        });
    }
}
