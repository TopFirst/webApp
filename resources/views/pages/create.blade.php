@extends('layouts/admin')

@section('title', '| Halaman Baru')

@push('css')
	<!-- summernote -->
	{{-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/trix-note/trix.css') }}">
	<script type="text/javascript" src="{{ asset('plugins/trix-note/trix.js') }}"></script>
	<style>
		trix-toolbar [data-trix-button-group="file-tools"]{
			display:none;
		}
	</style>
@endpush

@section('container')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Halaman Baru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fas fa-home"></i> Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Halaman</a></li>
                    <li class="breadcrumb-item active">Halaman Baru</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
		<form action="{{ route('pages.store') }}" method="POST">
		@csrf
		@method('POST')
        <div class="row">
            <div class="col-sm-12">
				<div class="row mb-1">
					<input type="text" name="title" id="title" class="col-12 form-control @error('title') is-invalid @enderror" placeholder="Judul halaman.." autofocus value="{{ old('title') }}">
				@error('title')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
				</div>
				<div class="row mb-3">
					<input type="text" name="slug" id="slug" class="col-12 form-control @error('slug') is-invalid @enderror" placeholder="Slug.." readonly value="{{ old('slug') }}">
					@error('slug')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				<div class="row">
					<div class="col-12 p-0">
						<div class="form-group">
							@error('content')
								<p class="text-danger">{{ $message }}</p>
							@enderror
							<input id="body" type="hidden" name="content" value="{{ old('content') }}">
							<trix-editor input="body"></trix-editor>
							{{-- <textarea class="textarea" style="height: 350px;"></textarea> --}}
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="row justify-content-between pb-3">
            <a href="{{ route('pages.index') }}" class="btn btn-default"><i class="fas fa-angle-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Halaman</button>
        </div>
	</form>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('scripts')
<!-- Summer Note -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script type="text/javascript">

	const title=document.querySelector('#title');
	const slug=document.querySelector('#slug');

	title.addEventListener('change',function(){
		fetch('/posts/checkSlug?title=' + title.value, {
			headers : { 
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			}
		})
		.then(response => response.json())
		.then(data => slug.value = data.slug)
	});
	document.addEventListener('trix-file-accept',function(e){
		e.preventDefault();
	})


</script>
@endpush