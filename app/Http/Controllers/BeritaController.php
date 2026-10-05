<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public const KATEGORI = [
        'ekonomi', 'keuangan', 'kunjungan', 'Olahraga', 'pembangunan', 'pemuda',
        'Pendidikan', 'potensi', 'Prestasi dan Apresiasi', 'tidak memiliki kategori',
    ];

    public function index(Request $request)
    {
        $beritas = Berita::query()
            ->when($request->kata_kunci, fn ($q, $k) => $q->where('judul', 'like', "%{$k}%"))
            ->when($request->kategori, fn ($q, $k) => $q->where('kategori', $k))
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return view('berita.index', ['beritas' => $beritas, 'kategoris' => self::KATEGORI]);
    }

    public function create()
    {
        return view('berita.create', ['kategoris' => self::KATEGORI]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'    => 'required|max:255',
            'kategori' => 'required',
            'gambar'   => 'nullable|url',
            'tags'     => 'nullable|max:255',
            'isi'      => 'required|min:10',
        ]);
        $data['penulis'] = 'Admin';

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show(Berita $berita)
    {
        $berita->increment('dilihat');

        $a = random_int(1, 10);
        $b = random_int(1, 10);
        session(['captcha' => $a + $b]);

        return view('berita.show', [
            'berita'   => $berita,
            'captcha'  => "$a + $b",
            'komentars' => $berita->komentars()->latest()->get(),
            'terkait'  => Berita::where('id', '!=', $berita->id)->orderByDesc('id')->limit(5)->get(),
        ]);
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', ['berita' => $berita, 'kategoris' => self::KATEGORI]);
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'judul'    => 'required|max:255',
            'kategori' => 'required',
            'gambar'   => 'nullable|url',
            'tags'     => 'nullable|max:255',
            'isi'      => 'required|min:10',
        ]);

        $berita->update($data);

        return redirect()->route('berita.show', $berita)->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function komentar(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'nama'    => 'required|max:100',
            'email'   => 'required|email',
            'no_hp'   => 'required|max:20',
            'pesan'   => 'required|max:300',
            'captcha' => 'required|numeric',
        ]);

        if ((int) $data['captcha'] !== (int) session('captcha')) {
            return back()->withInput()->withErrors(['captcha' => 'Jawaban captcha salah.']);
        }

        unset($data['captcha']);
        $berita->komentars()->create($data);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }
}
