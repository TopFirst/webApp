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
                        <form action="{{ route('posts.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label for="tipe" class="mt-2 mr-2">Tipe</label>
                                        <select name="tipe" id="tipe" class="form-control col-md-9">
                                            @foreach ($types as $tipe)
                                                @if(old('tipe') == $tipe->post_type_slug)
                                                    <option value="{{ $tipe->post_type_slug }}" selected>{{ $tipe->post_type_name }}</option>
                                                @else
                                                    <option value="{{ $tipe->post_type_slug }}">{{ $tipe->post_type_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label for="kategori" class="col-md-4 mt-2 text-right">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control col-md-8">
                                            @foreach ($categories as $category)
                                                @if(old('kategori') == $category->category_slug)
                                                    <option value="{{ $category->category_slug }}" selected>{{ $category->category_name }}</option>
                                                @else
                                                    <option value="{{ $category->category_slug }}">{{ $category->category_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-filter"></i> Filter</button>
                                        <a href="{{ route('posts.index') }}" class="btn btn-default">Reset</a>
                                    </div>
                                </div>
                        </div>
                    </form>
                    <table class="table col-sm-12 col-lg-12">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Tipe</th>
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
                                    <td>{{ $post->tipe->post_type_name }}</td>
                                    <td>{{ $post->kategori->category_name }}</td>
                                    <td style="width:150px;">
                                        <a href="{{ route('posts.lihat',$post->post_slug) }}" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                                        @can('post-edit')
                                        <a href="{{ route('posts.edit',$post->post_slug) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('post-delete')
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#konfirmasi_del_{{ str_replace("/","",$post->id) }}"><i
                                                class="fa fa-trash"></i></a>
                                                <!-- Konfirmasi Hapus -->
                                                <div class="modal fade" id="konfirmasi_del_{{ str_replace("/","",$post->id) }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form action="{{ route('posts.destroy',$post->post_slug) }}"
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