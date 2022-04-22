<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model
{
    use HasFactory;
    protected $table = 'aktifitas';
    protected $fillable = ['deskripsi', 'pegawai_id'];

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai_id', 'id');
    }
}
