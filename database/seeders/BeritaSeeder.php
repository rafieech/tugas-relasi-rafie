<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $admin  = User::where('email', 'admin@desa.test')->first();
        $editor = User::where('email', 'editor@desa.test')->first();

        $olahraga   = Kategori::where('nama', 'Olahraga')->first();
        $pendidikan = Kategori::where('nama', 'Pendidikan')->first();
        $potensi    = Kategori::where('nama', 'Potensi')->first();

        // Dibuat lewat relasi user: user_id terisi otomatis
        $b1 = $admin->beritas()->create([
            'judul'       => 'Turnamen Voli Antar Dusun Resmi Dibuka',
            'kategori_id' => $olahraga->id,
            'isi'         => 'Turnamen voli tahunan antar dusun resmi dibuka oleh kepala desa...',
        ]);
        $b2 = $editor->beritas()->create([
            'judul'       => 'Sosialisasi Bank Sampah untuk Warga',
            'kategori_id' => $pendidikan->id,
            'isi'         => 'Pemerintah desa mengadakan sosialisasi pengelolaan sampah...',
        ]);
        $b3 = $editor->beritas()->create([
            'judul'       => 'Panen Raya Kelompok Wanita Tani',
            'kategori_id' => $potensi->id,
            'isi'         => 'Kelompok wanita tani desa berhasil panen sayuran organik...',
        ]);

        $b1->tags()->attach(Tag::whereIn('nama', ['desa', 'kegiatan'])->pluck('id'));
        $b2->tags()->attach(Tag::whereIn('nama', ['warga', 'lingkungan'])->pluck('id'));
        $b3->tags()->attach(Tag::whereIn('nama', ['desa', 'ekonomi'])->pluck('id'));
    }
}
