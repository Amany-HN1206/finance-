<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('organization_balances', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_saldo', ['Kas', 'Bank']);
            $table->decimal('nominal', 18, 2)->default(0);
            $table->foreignId('terakhir_diperbarui_oleh')
                  ->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_balances');
    }
};