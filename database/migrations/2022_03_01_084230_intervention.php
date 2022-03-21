<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Intervention extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("intervention", function(Blueprint $table){
            $table->id();
            $table->integer("user_id");
            $table->integer("ticket_id");
            $table->timestamp("date_intervention");
            $table->string("description_intervention");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")
                ->onUpdate("restrict")
                ->onDelete("cascade");
            $table->foreign("ticket_id")->references("id")->on("tickets")
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
        Schema::dropIfExists('intervention');
    }
}
