<?php
// app/Models/Member.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'nim_or_id_anggota', 'nama_lengkap', 'email', 'password_hash',
        'jabatan_organisasi', 'no_telepon', 'status_aktif'
    ];

    protected $hidden = ['password_hash'];
    protected $casts = ['status_aktif' => 'boolean'];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function fundRequests()
    {
        return $this->hasMany(FundRequest::class, 'member_id');
    }
}