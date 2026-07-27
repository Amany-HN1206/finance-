<?php
// app/Models/FundRequest.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundRequest extends Model
{
    protected $table = 'fund_requests';

    protected $fillable = [
        'member_id', 'kategori_dana', 'nominal', 'keterangan_rincian',
        'metode_pencairan', 'status', 'disetujui_oleh', 'alasan_penolakan'
    ];

    protected $casts = ['nominal' => 'decimal:2'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function approver()
    {
        return $this->belongsTo(Admin::class, 'disetujui_oleh');
    }

    public function attachments()
    {
        return $this->hasMany(RequestAttachment::class, 'request_id');
    }

    public function mutations()
    {
        return $this->hasMany(BalanceMutation::class, 'request_id');
    }
}