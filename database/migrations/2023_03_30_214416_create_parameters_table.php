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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('detail');
            $table->integer('bobot');
            $table->integer('tertimbang')->nullable();
            $table->string('catatan')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->string('analisa')->nullable();
            $table->integer('id_indikator')->unsigned();
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
        Schema::dropIfExists('parameters');
    }
};
