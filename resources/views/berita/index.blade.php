@extends('layouts.app')

@section('title', 'Berita & Informasi')

@section('breadcrumb')
<li class="breadcrumb-item active">Berita</li>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-3 side-col">
        <div class="sticky-side">
            <div class="filter-box">
                <div class="filter-header"><i class="bi bi-funnel-fill me-2"></i>Filter Berita</div>
                <form method="GET" action="{{ route('berita.index') }}" class="p-4">
                    <label class="form-label fw-bold">Kata Kunci</label>
                    <input type="text" name="kata_kunci" class="form-control form-control-lg mb-4" value="{{ request('kata_kunci') }}" placeholder="Cari berita...">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="kategori" class="form-select mb-4">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $k)
                        <option value="{{ $k->id }}" @selected(request('kategori')==$k->id)>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success w-100 mb-2">Cari</button>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-dark w-100">Reset</a>
                </form>
            </div>
            <a href="{{ route('berita.create') }}" class="btn btn-warning fw-bold w-100 mt-3 py-2"><i class="bi bi-plus-circle-fill me-1"></i> Tambah Berita</a>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row">
            @forelse ($beritas as $berita)
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card card-berita h-100">
                    <a href="{{ route('berita.show', $berita) }}">
<img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top thumb" alt="{{ $berita->judul }}"                            onerror="this.src='https://placehold.co/600x400?text=Berita+Desa'">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge badge-kategori text-white">{{ $berita->kategori->nama }}</span> <span class="text-muted dt"><i class="bi bi-calendar3"></i> {{ $berita->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                        <a href="{{ route('berita.show', $berita) }}" class="judul mb-2">{{ Str::limit($berita->judul, 70) }}</a>
                        <p class="text-muted small flex-grow-1">{{ $berita->ringkasan }}</p>
                        <div class="mb-2">
                            @foreach ($berita->tags ?? [] as $tag)
                            <a href="{{ route('berita.index', ['tag' => $tag->id]) }}"
                                class="tag-pill text-decoration-none">#{{ $tag->nama }}</a>
                            @endforeach

                        </div>
                        <div class="d-flex justify-content-between align-items-center border-top pt-2">
                            <small class="text-muted"><i class="bi bi-eye-fill"></i> {{ number_format($berita->dilihat) }}</small>
                            <a href="{{ route('berita.show', $berita) }}" class="btn btn-sm btn-baca">Baca <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('berita.edit', $berita) }}" class="btn btn-sm btn-outline-warning flex-fill">Edit</a>
                            <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="flex-fill" onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">Berita tidak ditemukan.</p>
            @endforelse
        </div>

        @if ($beritas->total() > 0)
        <div class="mt-2">{{ $beritas->links() }}</div>
        @endif
    </div>
</div>
@endsection