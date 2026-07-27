<?php
// app/Models/RequestAttachment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RequestAttachment extends Model
{
    protected $table = 'request_attachments';
    public $timestamps = false;

    protected $fillable = ['request_id', 'file_path_url', 'file_type', 'uploaded_at'];

    public function request()
    {
        return $this->belongsTo(FundRequest::class, 'request_id');
    }

    public function getPublicUrlAttribute()
    {
        return Storage::disk('public')->url($this->file_path_url);
    }
}