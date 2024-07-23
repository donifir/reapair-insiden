<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_insidents', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('norm');
            $table->string('waktu_insiden');
            $table->string('insident');
            $table->string('kronologi_insiden');
            $table->string('jenis_insiden');
            $table->string('pelapor_insiden');
            $table->string('penjelasn_pelapor_insiden')->nullable();
            $table->string('korban_insiden');
            $table->string('penjelasan_korban_insiden')->nullable();
            $table->string('pasien_di');
            $table->string('penjelasan_pasien_di')->nullable();
            $table->string('tempat_insiden');
            $table->string('spesialis_korban');
            $table->string('penjelasan_spesialis_korban')->nullable();
            $table->string('unit_penyebab_insiden')->nullable();
            $table->string('akibat_insiden_kepasien')->nullable();
            $table->string('penanganan_insiden');
            $table->string('pelaku_penanganan');
            $table->string('penjelasan_pelaku_penanganan')->nullable();
            $table->string('insident_pernah_terjadi');
            $table->string('penjelasan_insident_pernah_terjadi')->nullable();
            $table->string('grading_resiko_kejadian')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_insidents');
    }
};
