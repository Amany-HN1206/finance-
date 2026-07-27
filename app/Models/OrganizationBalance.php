<?php
// app/Models/OrganizationBalance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationBalance extends Model
{
    protected $table = 'organization_balances';
    public $timestamps = false;

    protected $fillable = ['jenis_saldo', 'nominal', 'terakhir_diperbarui_oleh', 'updated_at'];

    protected $casts = ['nominal' => 'decimal:2'];

    public static function getSaldoKas()
    {
        return static::where('jenis_saldo', 'Kas')->value('nominal') ?? 0;
    }

    public static function getSaldoBank()
    {
        return static::where('jenis_saldo', 'Bank')->value('nominal') ?? 0;
    }

    public static function kurangiSaldo(string $jenis, float $nominal, int $adminId)
    {
        $balance = static::where('jenis_saldo', $jenis)->first();
        if (!$balance) return false;

        $sebelum = $balance->nominal;
        $balance->decrement('nominal', $nominal);
        $balance->terakhir_diperbarui_oleh = $adminId;
        $balance->updated_at = now();
        $balance->save();

        return $sebelum;
    }
}