@extends('layouts/admin')

@section('title', '| Daftar Post')

@section('container')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Artikel</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Artikel</li>
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
                        <h3 class="card-title">Daftar Artikel</h3>
                        <div class="card-tools"><a href="{{ route('posts.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Artikel Baru</a></div>
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
                                    <th>Kategori</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->post_title }}</td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>{{ $post->kategori->category_name }}</td>
                                    <td style="width:80px;">
                                        @can('post-edit')
                                        <a href="#" class="text-info"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('post-delete')
                                        <a href="#" class="text-danger" data-toggle="modal"
                                            data-target="#konfirmasi_del_{{ str_replace("/","",$post->id) }}"><i
                                                class="fa fa-trash"></i></a>
                                                <!-- Konfirmasi Hapus -->
                                                <div class="modal fade" id="konfirmasi_del_{{ str_replace("/","",$post->id) }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form action="{{ route('posts.destroy',$post->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <p>Apakah yakin menghapus artikel ini
                                                                        <b>{{ $post->post_title }}</b>?
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
                            <p class="mt-2">Jumlah data : {!! $posts->total() !!}</p>
                            <div class="float-right">
                                {!! $posts->links() !!}
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