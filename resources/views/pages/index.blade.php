@extends('layouts/admin')

@section('title', '| Daftar Halaman')

@section('container')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Halaman</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Halaman</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Halaman</h3>
                        <div class="card-tools"><a href="{{ route('pages.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Halaman Baru</a></div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table col-sm-12 col-lg-12">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->author->name }}</td>
                                    <td style="width:150px;">
                                        <a href="{{ route('pages.lihat',$page->slug) }}" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                                        @can('page-edit')
                                        <a href="{{ route('pages.edit',$page->slug) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('page-delete')
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#konfirmasi_del_{{ str_replace("/","",$page->id) }}"><i
                                                class="fa fa-trash"></i></a>
                                                <!-- Konfirmasi Hapus -->
                                                <div class="modal fade" id="konfirmasi_del_{{ str_replace("/","",$page->id) }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form action="{{ route('pages.destroy',$page->slug) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <p>Apakah yakin menghapus halaman ini
                                                                        <b>{{ $page->title }}</b>?
                                                                    </p>
                                                                    <div class="justify-content-between">
                                                                        <button type="button" class="btn btn-md btn-default"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <div class="float-right">
                                                                            <button type="submit"
                                                                                class="btn btn-md btn-outline-danger"><i
                                                                                    class="fa fa-trash"></i> Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="m-0 mb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <p class="mt-2">Jumlah data : {!! $pages->total() !!}</p>
                            <div class="float-right">
                                {!! $pages->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('scripts')

<script type="text/javascript">
    $(function () {

    });
</script>
@endpush