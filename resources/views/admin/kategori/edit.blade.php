@extends('layouts/main')

@section('content')
    <h4 class="page-title">{{ $title }}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Kategori</div>
                </div>
                <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('nama_kategori') has-error has-feedback @enderror">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="nama_kategori"
                                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="form-control"
                                        placeholder="Masukkan nama kategori..">
                                    @error('nama_kategori')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('deskripsi') has-error has-feedback @enderror">
                                    <label for="comment">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="comment" rows="5">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Edit</button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
