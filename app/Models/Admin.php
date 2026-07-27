<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    public $timestamps = true;

    protected $fillable = [
        'nama_lengkap', 
        'email', 
        'password_hash', 
        'no_telepon', 
        'role',
        'avatar_path',
        'lokasi_kantor',
    ];

    protected $hidden = ['password_hash'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function approvedRequests()
    {
        return $this->hasMany(FundRequest::class, 'disetujui_oleh');
    }

    public function mutations()
    {
        return $this->hasMany(BalanceMutation::class, 'admin_id');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar_path ? \Storage::url($this->avatar_path) : null;
    }
}