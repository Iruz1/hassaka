<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama asli file
            $table->string('filename'); // Nama file di sistem
            $table->string('path'); // Path penyimpanan
            $table->string('file_type'); // Tipe file
            $table->string('extension'); // Ekstensi file
            $table->integer('size'); // Ukuran file
            $table->text('description')->nullable(); // Deskripsi opsional
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
