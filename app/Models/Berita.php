<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    // Kolom yang boleh diisi lewat mass assignment (create/update)
    protected $fillable = ['judul', 'slug', 'kategori', 'gambar', 'isi', 'tags', 'penulis', 'dilihat'];

    protected static function booted(): void
    {
        static::creating(function (Berita $b) {
            if (empty($b->slug)) {
                $b->slug = Str::slug($b->judul);
            }
        });
    }

    // URL berita memakai slug (bukan id), seperti website asli
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

    public function getGambarUrlAttribute(): string
    {
        if (! $this->gambar) {
            return 'https://placehold.co/600x400?text=Berita+Desa';
        }
        return Str::startsWith($this->gambar, 'http') ? $this->gambar : asset('storage/' . $this->gambar);
    }

    public function getRingkasanAttribute(): string
    {
        return Str::limit(trim(html_entity_decode(strip_tags($this->isi))), 90);
    }

    public function getTagListAttribute(): array
    {
        return array_values(array_filter(array_map('trim', explode(',', (string) $this->tags))));
    }

    // Isi dari seeder berupa HTML; isi dari form (teks biasa) di-escape dulu
    public function getIsiHtmlAttribute(): string
    {
        return Str::contains($this->isi, '<p>') ? $this->isi : nl2br(e($this->isi));
    }
}
