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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order');
            $table->unsignedBigInteger('product_id')->nullable(); // buat field yg namanya "product_id" dirujukkan ke tabel products
            $table->foreign('product_id')->references('id')->on('products'); // jadikan sebagai foreign key, ambil rujukanny dr tabel products (PK => id)
            $table->string('nama');
            $table->string('no_wa');
            $table->string('alamat');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->enum('status',['New','Proses','Finished']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
