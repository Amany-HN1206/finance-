<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BalanceMutation;
use App\Models\FundRequest;
use App\Models\Member;
use App\Models\OrganizationBalance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin (Bendahara)
        $admin = Admin::create([
            'nama_lengkap' => 'Bendahara Utama IPJ',
            'email' => 'bendahara@ipj.id',
            'password_hash' => Hash::make('password123'),
            'no_telepon' => '+62 812 0000 0001',
            'role' => 'bendahara',
        ]);

        // 2. Anggota (5 sample)
        $members = [];
        $sampleMembers = [
            ['nim' => '2021010001', 'nama' => 'Aris Setiawan', 'email' => 'aris@ipj.id', 'jabatan' => 'Koordinator Divisi'],
            ['nim' => '2021010002', 'nama' => 'Siti Nurbaya', 'email' => 'siti@ipj.id', 'jabatan' => 'Staff Keuangan'],
            ['nim' => '2021010003', 'nama' => 'Budi Pratama', 'email' => 'budi@ipj.id', 'jabatan' => 'Anggota'],
            ['nim' => '2021010004', 'nama' => 'Rina Kusuma', 'email' => 'rina@ipj.id', 'jabatan' => 'Sekretaris'],
            ['nim' => '2021010005', 'nama' => 'Dewi Lestari', 'email' => 'dewi@ipj.id', 'jabatan' => 'Anggota'],
        ];

        foreach ($sampleMembers as $m) {
            $members[] = Member::create([
                'nim_or_id_anggota' => $m['nim'],
                'nama_lengkap' => $m['nama'],
                'email' => $m['email'],
                'password_hash' => Hash::make('password123'),
                'jabatan_organisasi' => $m['jabatan'],
                'no_telepon' => '+62 812 ' . rand(1000, 9999) . ' ' . rand(1000, 9999),
                'status_aktif' => true,
            ]);
        }

        // 3. Saldo Organisasi
        OrganizationBalance::create([
            'jenis_saldo' => 'Kas',
            'nominal' => 15000000,
            'terakhir_diperbarui_oleh' => $admin->id,
            'updated_at' => now(),
        ]);

        OrganizationBalance::create([
            'jenis_saldo' => 'Bank',
            'nominal' => 250000000,
            'terakhir_diperbarui_oleh' => $admin->id,
            'updated_at' => now(),
        ]);

        // 4. Sample Fund Requests
        $requests = [
            ['member' => $members[0], 'kategori' => 'Operasional', 'nominal' => 4500000, 'keterangan' => 'Pengadaan ATK & Printer Baru untuk Kantor', 'metode' => 'Transfer', 'status' => 'Pending'],
            ['member' => $members[1], 'kategori' => 'Konsumsi', 'nominal' => 2500000, 'keterangan' => 'Konsumsi Rapat Koordinasi Divisi', 'metode' => 'Cash', 'status' => 'Pending'],
            ['member' => $members[2], 'kategori' => 'Kas', 'nominal' => 12500000, 'keterangan' => 'Seminar Literasi Keuangan Digital 2024', 'metode' => 'Transfer', 'status' => 'Approved'],
            ['member' => $members[3], 'kategori' => 'Lainnya', 'nominal' => 8750000, 'keterangan' => 'Pengadaan Perangkat Keras Kantor', 'metode' => 'Transfer', 'status' => 'Rejected'],
            ['member' => $members[4], 'kategori' => 'Operasional', 'nominal' => 5350000, 'keterangan' => 'Biaya Operasional Audit Tahunan', 'metode' => 'Cash', 'status' => 'Approved'],
        ];

        foreach ($requests as $r) {
            $request = FundRequest::create([
                'member_id' => $r['member']->id,
                'kategori_dana' => $r['kategori'],
                'nominal' => $r['nominal'],
                'keterangan_rincian' => $r['keterangan'],
                'metode_pencairan' => $r['metode'],
                'status' => $r['status'],
                'disetujui_oleh' => $r['status'] !== 'Pending' ? $admin->id : null,
                'alasan_penolakan' => $r['status'] === 'Rejected' ? 'Dokumen tidak lengkap, mohon lengkapi nota pendukung.' : null,
            ]);

            if ($r['status'] === 'Approved') {
                $sumberSaldo = $r['metode'] === 'Cash' ? 'Kas' : 'Bank';
                $balance = OrganizationBalance::where('jenis_saldo', $sumberSaldo)->first();

                BalanceMutation::create([
                    'request_id' => $request->id,
                    'admin_id' => $admin->id,
                    'jenis_mutasi' => 'Outflow',
                    'sumber_saldo' => $sumberSaldo,
                    'nominal' => $r['nominal'],
                    'saldo_sebelum' => $balance->nominal + $r['nominal'],
                    'saldo_sesudah' => $balance->nominal,
                    'catatan' => 'Persetujuan pengajuan: ' . $r['keterangan'],
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }

        $this->command->info('✅ Seeder berhasil dijalankan!');
        $this->command->info('');
        $this->command->info('📧 Login Admin:');
        $this->command->info('   Email: bendahara@ipj.id');
        $this->command->info('   Password: password123');
        $this->command->info('');
        $this->command->info('📧 Login Anggota (semua password: password123):');
        foreach ($sampleMembers as $m) {
            $this->command->info('   ' . $m['email'] . ' (' . $m['nama'] . ')');
        }
    }
}