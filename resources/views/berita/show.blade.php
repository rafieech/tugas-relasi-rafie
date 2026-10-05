@extends('layouts.app')

@section('title', $berita->judul)

@section('judul', 'Detail Berita')
@section('subjudul', 'Desa Jalatrang')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-success text-decoration-none">Berita</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
@php $url = urlencode(request()->url()); $jdl = urlencode($berita->judul); @endphp
<div class="row">
    <div class="col-lg-8">
        <article class="bg-white rounded shadow-sm overflow-hidden mb-4">
            <img src="{{ $berita->gambar_url }}" class="w-100" style="max-height:420px;object-fit:cover" alt="{{ $berita->judul }}"
                 onerror="this.src='https://placehold.co/800x400?text=Berita+Desa'">
            <div class="p-4">
                <div class="d-flex flex-wrap align-items-center gap-2 small text-muted mb-2">
                    <span class="badge badge-kat">{{ $berita->kategori }}</span>
                    <span><i class="bi bi-calendar3"></i> {{ $berita->created_at->translatedFormat('l, d F Y') }}</span>
                    <span><i class="bi bi-person"></i> {{ $berita->penulis }}</span>
                    <span><i class="bi bi-eye"></i> {{ number_format($berita->dilihat) }} dibaca</span>
                </div>
                <h1 class="h3 fw-bold judul-halaman">{{ $berita->judul }}</h1>
                <div class="isi-berita">{!! $berita->isi_html !!}</div>

                <div class="mt-3">
                    <strong class="small">Tags:</strong>
                    @foreach ($berita->tag_list as $t)
                        <a href="{{ route('berita.index', ['kata_kunci' => $t]) }}" class="tag-pill">#{{ $t }}</a>
                    @endforeach
                </div>
                <div class="mt-3 pt-3 border-top d-flex flex-wrap align-items-center gap-2">
                    <strong class="small">Bagikan:</strong>
                    <a class="btn btn-sm btn-primary" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"><i class="bi bi-facebook"></i> Facebook</a>
                    <a class="btn btn-sm btn-dark" target="_blank" href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $jdl }}"><i class="bi bi-twitter-x"></i> Twitter</a>
                    <a class="btn btn-sm btn-success" target="_blank" href="https://wa.me/?text={{ $jdl }}%20{{ $url }}"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                    <span class="ms-auto d-flex gap-2">
                        <a href="{{ route('berita.edit', $berita) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="{{ route('berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </span>
                </div>
            </div>
        </article>

        <section class="bg-white rounded shadow-sm p-4 mb-4">
            <h5 class="fw-bold">Komentar ({{ $komentars->count() }})</h5>
            <h6 class="mt-3">Tulis Komentar Anda:</h6>
            <form method="POST" action="{{ route('berita.komentar', $berita) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label small fw-semibold">Nama Lengkap *</label>
                        <input name="nama" class="form-control" value="{{ old('nama') }}">
                        @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Alamat Email * <span class="badge bg-secondary">Privat</span></label>
                        <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Nomor HP * <span class="badge bg-secondary">Privat</span></label>
                        <input name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                        @error('no_hp') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Pesan Komentar *</label>
                        <textarea name="pesan" id="pesan" rows="3" maxlength="300" class="form-control">{{ old('pesan') }}</textarea>
                        <div class="d-flex justify-content-between small">
                            <span class="text-muted">Dilarang menggunakan kata kasar / ujaran kebencian.</span>
                            <span class="text-muted"><span id="sisa">300</span> karakter tersisa</span>
                        </div>
                        @error('pesan') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Pertanyaan Keamanan (Captcha Anti-Bot) *</label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold">{{ $captcha }} = ?</span>
                            <input name="captcha" class="form-control" inputmode="numeric">
                        </div>
                        @error('captcha') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12"><button class="btn btn-success"><i class="bi bi-send"></i> Kirim Komentar</button></div>
                </div>
            </form>
            <hr>
            @forelse ($komentars as $k)
                <div class="mb-3">
                    <strong>{{ $k->nama }}</strong> <small class="text-muted">{{ $k->created_at->diffForHumans() }}</small>
                    <p class="mb-0">{{ $k->pesan }}</p>
                </div>
            @empty
                <p class="text-muted text-center mb-0">Belum ada komentar. Jadilah yang pertama memberikan masukan!</p>
            @endforelse
        </section>

        <a href="{{ route('berita.index') }}" class="btn btn-outline-success"><i class="bi bi-arrow-left"></i> Kembali ke Daftar</a>
    </div>

    <div class="col-lg-4">
        <div class="filter-box">
            <div class="filter-header">Berita Terkait</div>
            <div class="p-3">
                @forelse ($terkait as $t)
                    <a href="{{ route('berita.show', $t) }}" class="d-flex gap-2 mb-3 text-decoration-none text-dark">
                        <img src="{{ $t->gambar_url }}" width="90" height="65" style="object-fit:cover;border-radius:6px" alt=""
                             onerror="this.src='https://placehold.co/90x65'">
                        <div><div class="small fw-semibold">{{ Str::limit($t->judul, 65) }}</div>
                            <small class="text-muted">{{ $t->created_at->translatedFormat('d M Y') }}</small></div>
                    </a>
                @empty
                    <p class="text-muted small mb-0">Belum ada berita terkait.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const p = document.getElementById('pesan'), s = document.getElementById('sisa');
    const hitung = () => s.textContent = 300 - p.value.length;
    p.addEventListener('input', hitung); hitung();
</script>
@endpush
