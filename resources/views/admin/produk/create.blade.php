@extends('layouts/main')

@section('content')
    <h4 class="page-title">{{ $title }}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Produk</div>
                </div>
                <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('nama_produk') has-error has-feedback @enderror">
                                    <label>Nama Produk</label>
                                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                                        class="form-control" placeholder="Masukkan nama produk..">
                                    @error('nama_produk')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('kategori_id') has-error has-feedback @enderror">
                                    <label for="exampleFormControlSelect1">Kategori</label>
                                    <select name="kategori_id" class="form-control" id="exampleFormControlSelect1">
                                        <option selected value="" disabled>-- pilih kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}"
                                                @if (old('kategori_id') == $k->id) selected @endif>
                                                {{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('harga') has-error has-feedback @enderror">
                                    <label>Harga</label>
                                    <input type="number" name="harga" value="{{ old('harga') }}" class="form-control"
                                        placeholder="Masukkan harga produk..">
                                    @error('harga')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('stok') has-error has-feedback @enderror">
                                    <label>Stok</label>
                                    <input type="number" name="stok" value="{{ old('stok') }}" class="form-control"
                                        placeholder="Masukkan stok produk..">
                                    @error('stok')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('gambar_produk') has-error has-feedback @enderror">
                                    <label for="exampleFormControlFile1">Gambar</label>
                                    <input type="file" name="gambar_produk" class="form-control-file"
                                        id="exampleFormControlFile1">
                                    @error('gambar_produk')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('deskripsi') has-error has-feedback @enderror">
                                    <label for="comment">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="comment" rows="5">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Tambah</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
