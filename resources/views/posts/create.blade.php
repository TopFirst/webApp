@extends('layouts/admin')

@section('title', '| Post Baru')

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
		<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('POST')
        <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-12">
				<div class="row mb-1">
					<input type="text" name="post_title" id="title" class="col-12 form-control @error('post_title') is-invalid @enderror" placeholder="Judul artikel.." autofocus value="{{ old('post_title') }}">
				@error('post_title')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
				</div>
				<div class="row mb-3">
					<input type="text" name="post_slug" id="slug" class="col-12 form-control @error('post_slug') is-invalid @enderror" placeholder="Slug.." readonly value="{{ old('post_slug') }}">
					@error('post_slug')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				<div class="row">
					<div class="col-12 p-0">
						<div class="form-group">
							@error('post_content')
								<p class="text-danger">{{ $message }}</p>
							@enderror
							<input id="body" type="hidden" name="post_content" value="{{ old('post_content') }}">
							<trix-editor input="body"></trix-editor>
							{{-- <textarea class="textarea" style="height: 350px;"></textarea> --}}
						</div>
					</div>
				</div>
            </div>
			<div class="col-md-3">
				<!-- Post Type -->
				<div class="row ml-md-2">
					<div class="card col-12">
						<div class="card-header p-2">
							<p class="card-title">Tipe Artikel</p>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-1">
							<select class="form-control col-12" name="post_type">
								@foreach ($post_types as $post_type)
									@if(old('post_type') == $post_type->id)
										<option value="{{ $post_type->id }}" selected>{{ $post_type->post_type_name }}</option>
									@else
										<option value="{{ $post_type->id }}">{{ $post_type->post_type_name }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- Kategori -->
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
							<select class="form-control col-12" name="category_ID">
								@foreach ($categories as $category)
									@if(old('category_ID') == $category->id)
										<option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
									@else
										<option value="{{ $category->id }}">{{ $category->category_name }}</option>
									@endif
								@endforeach
							</select>
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
								<input type="text" name="tags" class="form-control col-12" placeholder="tags..">
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
					<div class="card col-12">
						<div class="card-header p-2">
							<h4 class="card-title">Gambar Utama</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-2">
							<img class="img-preview img-fluid">
							<input type="file" class="text @error('post_thumbnail') is-invalid @enderror" name="post_thumbnail" id="image" onchange="previewImage()">
							@error('post_thumbnail')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="row ml-md-2">
					<div class="card col-12">
						<div class="card-header p-2">
							<h4 class="card-title">Terbitkan</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-2">
							<button type="submit" class="btn btn-info col-12"><i class="fas fa-save"></i> Simpan Semua</button>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				
			</div>
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
    $(function () {
        // Summernote
        $('.textarea').summernote()
    });
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

function previewImage()
{
	const image=document.querySelector('#image');
	const imgPreview=document.querySelector('.img-preview');

	imgPreview.style.display='block';
	const oFReader= new FileReader();
	oFReader.readAsDataURL(image.files[0]);

	oFReader.onload=function(oFREvent){
		imgPreview.src=oFREvent.target.result;
	}
}



</script>
@endpush