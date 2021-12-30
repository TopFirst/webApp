@extends('layouts/admin')

@section('title', '| Post Baru')

@push('css')
	<!-- summernote -->
	<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush

@section('container')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Artikel Baru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fas fa-home"></i> Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Artikel Baru</li>
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
            <div class="col-md-9 col-lg-9 col-sm-12">
				<div class="row mb-3">
					<input type="text" name="txtjudul" class="col-12 form-control" placeholder="Judul artikel..">
				</div>
				<div class="row">
					<div class="col-12 p-0">
						<div class="form-group">
							<textarea class="textarea" style="height: 350px;"></textarea>
						</div>
					</div>
				</div>
            </div>
			<div class="col-md-3">
				<div class="row ml-md-2">
					<div class="card col-12">
						<div class="card-header p-2">
							<p class="card-title">Kategori</p>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-1">
							@foreach ($categories as $category)
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="chkcategory" id="cat_{{ $category->id }}">
								<label class="form-check-label" for="cat_{{ $category->id }}">{{ $category->category_name }}</label>
							</div>
							@endforeach
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="row ml-md-2">
					<div class="card col-12">
						<div class="card-header p-2">
							<p class="card-title">Tags</p>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-2 mb-3">
							<div class="input-group">
								<input type="text" class="form-control col-12" placeholder="tags..">
								<span class="input-group-append">
									<button class="btn btn-info">Tambah</button>
								</span>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="row ml-md-2">
					<div class="card">
						<div class="card-header p-2">
							<h4 class="card-title">Gambar Utama</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-2">
							<input type="file" class="text">
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
<!-- Summer Note -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        // Summernote
        $('.textarea').summernote()
    });
</script>
@endpush