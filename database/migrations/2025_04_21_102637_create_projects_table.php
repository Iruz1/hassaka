<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('project_name');
            $table->string('location');
            $table->text('description');

            // Relasi dengan users
            $table->foreignId('owner_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('marketing_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes(); // Optional: jika ingin menggunakan soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
