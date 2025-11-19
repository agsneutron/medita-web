<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePaymentsAddPriceFkIdProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Program Id no debe de ser nullable
        Schema::table('payments', function (Blueprint $table) {
            $table->float('price')->nullable(false)->after('payment_method');
            $table->foreignId('programs_id')->nullable(true);
            $table->foreign('programs_id')
                ->references('id')
                ->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['programs_id']);
            $table->dropColumn('programs_id');
            $table->dropColumn('price');
        });
    }
}
