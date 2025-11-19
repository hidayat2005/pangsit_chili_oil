<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pesanan')->unique();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_pesanan', ['menunggu', 'dikonfirmasi', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->boolean('whatsapp_terkirim')->default(false);
            $table->timestamp('whatsapp_terkirim_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};