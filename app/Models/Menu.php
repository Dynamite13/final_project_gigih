<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'harga',
        'deskripsi',
        'stok',
        'created_by',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
