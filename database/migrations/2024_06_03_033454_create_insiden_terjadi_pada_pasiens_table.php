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
        Schema::create('insiden_terjadi_pada_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->boolean('keterangan_lanjutan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insiden_terjadi_pada_pasiens');
    }
};
