@extends('layouts.app')

@section('title', 'Tambah Berita')
@section('judul', 'Tambah Berita')
@section('subjudul', 'Desa Jalatrang')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('berita.index') }}" class="text-success text-decoration-none">Berita</a>
</li>
<li class="breadcrumb-item active">Tambah Berita</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="filter-box">
            <div class="filter-header">Tambah Berita</div>

            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Berita</label>
                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        class="form-control"
                        value="{{ old('judul') }}">
                    @error('judul')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $k)
                        <option value="{{ $k->id }}" @selected(old('kategori_id')==$k->id)>
                            {{ $k->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold d-block">Tags</label>
                    @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="tags[]"
                            id="tag{{ $tag->id }}"
                            value="{{ $tag->id }}"
                            @checked(in_array($tag->id, (array) old('tags', [])))
                        >
                        <label class="form-check-label" for="tag{{ $tag->id }}">
                            #{{ $tag->nama }}
                        </label>
                    </div>
                    @endforeach
                    @error('tags')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Gambar (opsional)</label>
                    <input
                        type="file"
                        name="gambar"
                        id="gambar"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                    @error('gambar')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-semibold">Isi Berita</label>
                    <textarea name="isi" id="isi" rows="8" class="form-control">{{ old('isi') }}</textarea>
                    @error('isi')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 border-top pt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection