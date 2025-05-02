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
    // 2NF - Hapus kolom redundant dengan pengecekan
    Schema::table('projects', function (Blueprint $table) {
        if (Schema::hasColumn('projects', 'owner_name')) {
            $table->dropColumn('owner_name');
        }
        if (Schema::hasColumn('projects', 'marketing_name')) {
            $table->dropColumn('marketing_name');
        }
    });

    // 3NF - Hapus ketergantungan transitif
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'role_name')) {
            $table->dropColumn('role_name');
        }
    });

    // Tambahkan tabel junction untuk relasi many-to-many
    if (!Schema::hasTable('project_user')) {
        Schema::create('project_user', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->primary(['project_id', 'user_id']);
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
