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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->unsignedBigInteger('harga_produk');
            $table->unsignedInteger('stok_produk');
            $table->string('gambar_produk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
