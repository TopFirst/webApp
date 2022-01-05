@extends('layouts/admin')

@section('title', '| Master')

@section('container')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Master</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fas fa-home"></i> Beranda</a></li>
                    <li class="breadcrumb-item active">Master</li>
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
			<div class="col-md-3">
				<!-- Kategori -->
				<div class="row ml-md-2">
					<div class="card col-12 p-0 m-0">
						<div class="card-header p-0 m-0">
                            <form action="{{ route('masters.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="input-group col-12 p-0 m-0">
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" placeholder="Kategori Baru.."/>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                @error('category_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </form>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-1">
                            <ul class="todo-list p-0" data-widget="todo-list">
								@foreach ($categories as $category)
                                    <li class="text">
                                        {{ $category->category_name }}
                                        <div class="tools">
                                            <a href="#" data-toggle="modal" class="text-decoration-none text-danger" data-target="#hapus_{{ $category->id }}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </li>
                                    <!-- Konfirmasi Hapus -->
                                    <div class="modal fade" id="hapus_{{ $category->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form action="{{ route('masters.destroy',$category->category_slug) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <p>Apakah yakin menghapus artikel ini
                                                            <b>{{ $category->category_name }}</b>?
                                                        </p>
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
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
								@endforeach
                            </ul>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('scripts')
<script type="text/javascript">

</script>
@endpush