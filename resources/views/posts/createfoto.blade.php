@extends('layouts/admin')

@section('title', '| Post Foto Baru')

@push('css')
	<!-- summernote -->
	{{-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/trix-note/trix.css') }}">
	<script type="text/javascript" src="{{ asset('plugins/trix-note/trix.js') }}"></script>
	<style>
		trix-toolbar [data-trix-button-group="file-tools"]{
			display:none;
		}

    .preview-image img
    {
          padding: 10px;
          /* max-width: 100px; */
		  max-height: 100px;
		  border: 1px solid #ddd;
		  padding: 1px 1px 0px 1px;
		  margin-right: 5px;
    }
        
	</style>
@endpush

@section('container')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Post Foto Baru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fas fa-home"></i> Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Post Foto Baru</li>
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
				<div class="row mb-1">
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
                <div class="row">
                    {{-- <div class="col-12 mb-3">
                        <label for="pro-image" class="form-label">Pilih Beberapa Foto</label>
                        <input class="text col-12 @error('item_content') is-invalid @enderror" type="file" id="pro-image" name="item_content[]" accept=".jpeg,.png,.jpg,.svg" multiple>
                        @error('item_content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="preview-images-zone"></div>
                      </div> --}}

					<div class="col-md-12 mb-2">
						<div class="form-control">
							<input type="file" id="item_content" name="item_content[]" placeholder="Pilih File" accept=".jpeg,.png,.jpg,.svg" multiple >
						</div>
						@error('item_content')
							<p class="text-danger fs-10">{{ $message }}</p>
						@enderror
					</div>
					
					<div class="col-md-12 border" >
						<div class="mt-1 text-center">
							<div class="preview-image"> </div>
						</div>  
					</div>

				</div>
            </div>
			<div class="col-md-3">
				<!-- Post Type -->
                <input type="hidden" name="post_type_slug" value="foto">
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
							<input type="file" class="text @error('post_thumbnail') is-invalid @enderror" name="post_thumbnail" id="image" accept=".jpeg,.png,.jpg,.svg" onchange="previewImage()">
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
<script type="text/javascript">

$(function() {
    // Multiple images preview with JavaScript
    var multiImgPreview = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#item_content').on('change', function() {
        multiImgPreview(this, 'div.preview-image');
    });
  });  

$(document).ready(function() {

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