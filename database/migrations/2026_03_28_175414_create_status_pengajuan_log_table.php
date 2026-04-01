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
        Schema::create('status_pengajuan_log', function (Blueprint $table) {
            $table->string('id_status', 10)->primary();
            $table->string('id_pengajuan', 10);
            $table->string('status', 50);
            $table->dateTime('tanggal_status');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pengajuan_log');
    }
};
