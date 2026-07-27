<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('balance_mutations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->nullable()->constrained('fund_requests')->nullOnDelete();
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->enum('jenis_mutasi', ['Inflow', 'Outflow']);
            $table->enum('sumber_saldo', ['Kas', 'Bank']);
            $table->decimal('nominal', 18, 2);
            $table->decimal('saldo_sebelum', 18, 2);
            $table->decimal('saldo_sesudah', 18, 2);
            $table->text('catatan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balance_mutations');
    }
};