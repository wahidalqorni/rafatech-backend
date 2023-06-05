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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('kode_product');
            $table->string('nama_product');
            $table->string('gambar')->nullable();
            $table->string('kategori')->nullable();
            $table->integer('harga');
            $table->text('deskripsi')->nullable();
            $table->enum('status',['Publish','Unpublish']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
