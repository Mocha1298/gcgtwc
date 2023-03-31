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
        Schema::create('sub_factors', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('detail');
            $table->integer('skor')->nullable();
            $table->boolean('dokumen')->nullable();
            $table->boolean('kuesioner')->nullable();
            $table->boolean('wawancara')->nullable();
            $table->boolean('observasi')->nullable();
            $table->integer('id_faktor')->unsigned();
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
        Schema::dropIfExists('sub_factors');
    }
};
