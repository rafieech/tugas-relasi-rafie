@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('judul', 'Tambah Berita')
@section('subjudul', 'Desa Jalatrang')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-success text-decoration-none">Berita</a></li>
    <li class="breadcrumb-item active">Tambah Berita</li>
@endsection

@section('content')
@php $b = isset($berita) ? $berita : null; @endphp
<div class="row justify-content-center"><div class="col-lg-8">
<div class="filter-box">
    <div class="filter-header">Tambah Berita</div>
    <form action="{{ route('berita.store') }}" method="POST" class="p-3">
        @csrf
        
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $b?->judul) }}">
            @error('judul') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="kategori" class="form-select">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $k)
                    <option value="{{ $k }}" @selected(old('kategori', $b?->kategori) == $k)>{{ $k }}</option>
                @endforeach
            </select>
            @error('kategori') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">URL Gambar (opsional)</label>
            <input type="text" name="gambar" class="form-control" value="{{ old('gambar', $b?->gambar) }}" placeholder="https://...">
            @error('gambar') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Tags (pisahkan dengan koma)</label>
            <input type="text" name="tags" class="form-control" value="{{ old('tags', $b?->tags) }}" placeholder="desa,jalatrang">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Isi Berita</label>
            <textarea name="isi" rows="8" class="form-control">{{ old('isi', $b?->isi) }}</textarea>
            @error('isi') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex gap-2 border-top pt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
            <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
</div></div>
@endsection
