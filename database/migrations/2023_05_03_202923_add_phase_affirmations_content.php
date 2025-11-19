<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhaseAffirmationsContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phases', function (Blueprint $table){
            $table->mediumText('affirmations')->nullable()->after('url_manual');
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
            $table->dropColumn('affirmations');
        });
    }
}
