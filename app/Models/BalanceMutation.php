<?php
// app/Models/BalanceMutation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceMutation extends Model
{
    protected $table = 'balance_mutations';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'request_id', 'admin_id', 'jenis_mutasi', 'sumber_saldo',
        'nominal', 'saldo_sebelum', 'saldo_sesudah', 'catatan', 'created_at'
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'saldo_sebelum' => 'decimal:2',
        'saldo_sesudah' => 'decimal:2',
    ];

    public function request()
    {
        return $this->belongsTo(FundRequest::class, 'request_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}