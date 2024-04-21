<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'JudulFoto',
        'DeskripsiFoto',
        'TanggalUngguh',
        'LokasiFIle',
        'album_id',
        'user_id',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function komentarfoto()
    {
        return $this->hasMany(KomentarFoto::class);
    }

    public function likefoto()
    {
        return $this->hasMany(LikeFoto::class);
    }

}
