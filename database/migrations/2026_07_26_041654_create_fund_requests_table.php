<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fund_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->enum('kategori_dana', ['Kas', 'Operasional', 'Konsumsi', 'Lainnya']);
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan_rincian');
            $table->enum('metode_pencairan', ['Cash', 'Transfer']);
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->foreignId('disetujui_oleh')
                  ->nullable()->constrained('admins')->nullOnDelete();
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_requests');
    }
};