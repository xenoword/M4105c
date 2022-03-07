<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Probleme;
use App\Models\User;
use phpDocumentor\Reflection\Types\Nullable;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('computer');
            $table->string('link_attached_file')->nullable();
            $table->integer('urgency');
            $table->integer('redirection');
            $table->string('comment')->nullable();
            $table->timestamp('date_start');
            $table->timestamp('date_end')->nullable();
            $table->integer("probleme_id")->nullable();
            $table->integer("precision_probleme_id")->nullable();
            $table->integer("user_id");
            $table->timestamps();

            $table->foreign("probleme_id")->references("id")->on("problemes")
                ->onUpdate("restrict")
                ->onDelete("cascade");
            $table->foreign("precision_probleme_id")->references("id")->on("precision_problemes")
                ->onUpdate("restrict")
                ->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")
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
        Schema::dropIfExists('tickets');
    }
}
