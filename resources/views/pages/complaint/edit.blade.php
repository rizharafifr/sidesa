@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Aduan</h1>
    </div>
    <!-- End Page Heading -->

    <div class="row">
        <div class="col">
            <form action="/complaint/{{ $complaint->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="title" class="">Judul</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $complaint->title) }}">
                            @error('title')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="content" class="">Isi Aduan</label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" cols="30"
                                rows="10">{{ old('content', $complaint->content) }}</textarea>
                            @error('content')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="photo_proof" class="">Foto Bukti</label>
                            <input type="file" name="photo_proof" id="photo_proof"
                                class="form-control @error('photo_proof') is-invalid @enderror"
                                value="{{ old('photo_proof') }}">
                            @error('photo_proof')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap: 10px;">
                            <a href="/complaint" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
