<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('ingredienti') -> nullable();
            $table->string('descrizione') -> nullable();
            $table->string('prezzo');
            $table->boolean('visibile');
            $table->string('sconto') -> nullable();
            $table->boolean('disponibile');
            $table->string('immagine') -> nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plates');
    }
}
