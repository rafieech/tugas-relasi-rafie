<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['berita_id', 'nama', 'email', 'no_hp', 'pesan'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
