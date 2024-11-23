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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('isbn')->nullable();
            $table->string('judul', 50);
            $table->string('slug', 50);
            $table->foreignId('kategori_id')->constrained('kategori_dan_raks')->onDelete('cascade');
            $table->string('penulis', 50);
            $table->string('penerbit', 50);
            $table->integer('tahun_terbit');
            $table->integer('stok_buku');
            $table->text('deskripsi')->nullable();
            $table->string('sampul')->default('sampul.png');
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
