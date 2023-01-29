<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_team', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('match_id')->unsigned();
            $table->bigInteger('team1_id')->unsigned();
            $table->bigInteger('team2_id')->unsigned();
            $table->bigInteger('team1_score')->default(0);
            $table->bigInteger('team2_score')->default(0);
            $table->timestamps();

            // $table->foreign('match_id')->references('match_id')->on('matches');
            // $table->foreign('team1_id')->references('team_id')->on('teams');
            // $table->foreign('team2_id')->references('team_id')->on('teams');


            $table->index(['match_id', 'team1_id', 'team2_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_team');
    }
};
