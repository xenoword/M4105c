<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CanResolve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("can_resolve", function(Blueprint $table){
            $table->integer("user_id");
            $table->integer("precision_probleme_id");

            $table->primary(["user_id", "precision_probleme_id"]);

            $table->foreign("user_id")->references("id")->on("users")
                ->onUpdate("restrict")
                ->onDelete("cascade");
            $table->foreign("precision_probleme_id")->references("id")->on("precision_problemes")
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
        Schema::dropIfExists('can_resolve');
    }
}
