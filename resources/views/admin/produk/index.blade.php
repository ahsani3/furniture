@extends('layouts/main')

@section('content')
    @if (session('success'))
        @section('script')
            <script type="text/javascript">
                swal("Berhasil", "{{ session('success') }}", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    },
                }).then((e) => {
                    if (e) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                });
            </script>
        @endsection
    @endif
    @if (session('error'))
        @section('script')
            <script type="text/javascript">
                swal("Gagal", "{{ session('error') }}", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                }).then((e) => {
                    if (e) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                });
            </script>
        @endsection
    @endif
    <h4 class="page-title">{{ $title }}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Produk</h4>
                        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Produk
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($produk as $p)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('/storage/uploads/' . $p->gambar_produk) }}" alt=""
                                                width="50">
                                        </td>
                                        <td>{{ $p->nama_produk }}</td>
                                        <td>{{ $p->harga }}</td>
                                        <td>{{ $p->stok }}</td>
                                        <td>{{ $p->nama_kategori }}</td>
                                        <td>{{ $p->deskripsi }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('produk.edit', $p->id) }}"
                                                    class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" title="" class="btn btn-link btn-danger"
                                                    data-toggle="modal" data-target="#hapus{{ $p->id }}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapus{{ $p->id }}" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">
                                                            Hapus Produk
                                                        </span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('produk.destroy', $p->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        {{-- <p class="small">Create a new row using this form, make sure you fill them all</p> --}}

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <h5>Apakah anda yakin ingin menghapus produk
                                                                    <b>"{{ $p->nama_produk }}"</b>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                    <input type="hidden" name="old_img" value="{{ $p->gambar_produk }}">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
