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
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan');
            $table->string('nama');
            $table->string('jenis');//Aspek, Indikator, Parameter, Faktor dan Unsur
            $table->string('keterangan')->nullable();//Optional

            $table->float('bobot')->nullable();//Inisialisasi
            $table->float('tertimbang')->nullable();//Nilai terhitung
            
            $table->string('catatan')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->string('analisis')->nullable();
            
            $table->boolean('dokumen')->nullable();
            $table->boolean('kuesioner')->nullable();
            $table->boolean('wawancara')->nullable();
            $table->boolean('observasi')->nullable();

            $table->boolean('dokumen_file')->nullable();
            $table->boolean('kuesioner_file')->nullable();
            $table->boolean('wawancara_file')->nullable();
            $table->boolean('observasi_file')->nullable();
            
            $table->integer('isian')->nullable();
            $table->float('skor')->nullable();
            
            $table->integer("id_parent")->unsigned()->nullable();
            $table->integer('tahun')->nullable();
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
        Schema::dropIfExists('masters');
    }
};
