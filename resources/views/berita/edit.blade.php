@extends('layouts.app')

@section('title', 'Edit Berita')

@section('judul', 'Edit Berita')

@section('subjudul', 'Desa Jalatrang')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('berita.index') }}" class="text-success text-decoration-none">Berita</a>
</li>
<li class="breadcrumb-item active">Edit Berita</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="filter-box">
            <div class="filter-header">Edit Berita</div>

            <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul</label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul', $berita->judul) }}">
                    @error('judul')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="kategori_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $k)
                        <option
                            value="{{ $k->id }}"
                            @selected(old('kategori_id', $berita->kategori_id) == $k->id)
                            >
                            {{ $k->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tags</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($tags as $tag)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="tags[]"
                                id="tag{{ $tag->id }}"
                                value="{{ $tag->id }}"
                                @checked(in_array($tag->id, old('tags', $berita->tags->pluck('id')->toArray())))
                            >
                            <label class="form-check-label" for="tag{{ $tag->id }}">
                                {{ $tag->nama }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('tags')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    @error('tags.*')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Berita (opsional)</label>

                    @if ($berita->gambar)
                    <div class="mb-2">
                        <p class="small text-muted mb-1">Gambar saat ini:</p>
                        <img
                            src="{{ asset('storage/' . $berita->gambar) }}"
                            alt="Gambar berita"
                            style="max-width: 200px; max-height: 150px; object-fit: cover;"
                            class="rounded">
                    </div>
                    @endif

                    <input
                        type="file"
                        name="gambar"
                        id="gambar"
                        class="form-control"
                        accept="image/*">
                    <small class="text-muted">Format JPG, PNG, atau WEBP. Maksimal 2 MB. Kosongkan jika tidak ingin mengganti gambar.</small>

                    @error('gambar')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Isi Berita</label>
                    <textarea name="isi" rows="8" class="form-control">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 border-top pt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection