<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecisionProblemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precision_problemes', function (Blueprint $table) {
            $table->id();
            $table->string("libelle");
            $table->integer("probleme_id");
            $table->timestamps();

            $table->foreign("probleme_id")->references("id")->on("problemes")
                ->onUpdate("restrict")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precision_problemes');
    }
}
