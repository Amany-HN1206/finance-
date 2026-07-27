<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nim_or_id_anggota')->unique();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('jabatan_organisasi')->nullable();
            $table->string('no_telepon')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};