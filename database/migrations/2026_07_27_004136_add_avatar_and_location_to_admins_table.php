<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('avatar_path')->nullable()->after('password_hash');
            $table->string('lokasi_kantor')->nullable()->after('no_telepon');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['avatar_path', 'lokasi_kantor']);
        });
    }
};