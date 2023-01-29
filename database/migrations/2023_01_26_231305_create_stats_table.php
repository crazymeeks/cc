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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('match_id');
            $table->bigInteger('team_id');
            $table->bigInteger('player_id');
            $table->bigInteger('param_id');
            $table->string('param_name', 500);
            $table->string('value', 10);
            $table->timestamps();

            $table->index(['param_id', 'param_name', 'match_id', 'player_id', 'team_id', 'value']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_stats');
    }
};
