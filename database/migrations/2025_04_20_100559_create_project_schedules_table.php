<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('project_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('Tanggal pelaksanaan project');
            $table->string('project_name', 255)->comment('Nama project');
            $table->string('location', 255)->comment('Lokasi project');
            $table->text('description')->comment('Deskripsi project');
            $table->timestamps(); // created_at dan updated_at

            // Optional: tambahkan index untuk pencarian yang lebih cepat
            $table->index('date');
            $table->index('project_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('project_schedules');
    }
};
