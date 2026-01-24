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
        Schema::table('produk', function (Blueprint $table) {
            $table->index('nama_produk');
            $table->index('status');
        });

        Schema::table('pesanan', function (Blueprint $table) {
            $table->index('status_pesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropIndex(['nama_produk']);
            $table->dropIndex(['status']);
        });

        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropIndex(['status_pesanan']);
        });
    }
};
