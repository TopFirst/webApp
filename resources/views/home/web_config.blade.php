@extends('layouts/admin')

@section('title', '| Pengaturan Web')

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
                <h1 class="m-0 text-dark">Pengaturan Web</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Pengaturan Web</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        @foreach ($web_configs as $item)
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-0 my-1 p-0">
                        <div class="card-body m-0 p-2">
                            <form method="POST" action="{{ route('home.ubahconfig',$item->id) }}">
                                @csrf
                                @method('POST')
                                {{-- <input type="hidden" name="id" value="{{ $item->id }}"> --}}
                                <div class="form-group row m-0 p-0">
                                    <label for="parameter_value" class="col-lg-3 mt-1">{{ $item->opt_name }}</label>
                                    @if($item->opt_type=='paragraf')
                                        <div class="col-lg-6">
                                            <input id="body" type="hidden" name="opt_value" value="{{ old('post_content',$item->opt_value ) }}">
                                            <trix-editor input="body"></trix-editor>
                                        </div>
                                    @elseif($item->opt_type=='picture/png')
                                        <div class="input-group col-lg-6 px-0">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="opt_value" name="opt_value"
                                                    accept=".jpeg,.png,.jpg,.svg">
                                                <label class="custom-file-label" for="opt_value">Pilih</label>
                                            </div>
                                        </div>
                                    @else
                                        <input type="text" class="form-control col-lg-6" name="opt_value" value="{{ $item->opt_value }}" />
                                    @endif
                                    
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-info float-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('scripts')
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		bsCustomFileInput.init();
	});
    $(function () {

    });
</script>
@endpush