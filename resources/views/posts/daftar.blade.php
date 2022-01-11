@extends('layouts/app')

@section('title', '| Daftar Artikel')

@push('css')
        <!-- Theme style -->
  {{-- <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}"> --}}
@endpush

@section('content')
<div class="container">

    <h1 class="mb-3 text-center">{{ $title }}</h1>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="{{ route('posts.daftar') }}">

                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari.." name="search" value="{{ request('search') }}" >
                    <button class="btn btn-secondary" type="submit">Cari Artikel</button>
                  </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3">
            <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-dark">
                @if ($posts[0]->post_thumbnail)
                <div style="max-height:400px; overflow:hidden;">
                    <img src="{{ asset('uploads/' . $posts[0]->post_thumbnail) }}" alt="{{ $posts[0]->post_thumbnail }}" class="card-img-top">
                </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->kategori->category_name }}" alt="{{ $posts[0]->post_thumbnail }}" class="card-img-top">
                @endif
            </a>

            <div class="card-body text-center">
            <h5 class="card-title"><a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-dark">{{ $posts[0]->post_title }}</a></h5>
            <p>Oleh 
                <a href="{{ route('posts.daftar') }}?author={{ $posts[0]->author->username }}" class="text-decoration-none text-dark">{{ $posts[0]->author->name??'-' }}</a> 
                : 
                <a href="{{ route('posts.daftar') }}?category={{ $posts[0]->kategori->category_slug }}" class="text-decoration-none text-dark">{{ $posts[0]->kategori->category_name??'-' }}</a>
                 - 
                {{ $posts[0]->created_at->diffForHumans() }}</p>
            <p class="card-text">{{ $posts[0]->post_short_content }}</p>
            <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none btn btn-primary">Selengkapnya..</a>
            {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
            </div>
        </div>
    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0, 0, 0, 0.7)">
                            <a href="{{ route('posts.daftar') }}?category={{ $post->kategori->category_slug }}" class="text-decoration-none text-white">{{ $post->kategori->category_name??'-' }}</a>
                        </div>

                        <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">
                            @if ($post->post_thumbnail)
                                <img src="{{ asset('uploads/' . $post->post_thumbnail) }}" alt="{{ $post->post_thumbnail }}" class="card-img-top">
                            @else
                                <img src="https://source.unsplash.com/500x400?{{ $post->kategori->category_name }}" alt="{{ $post->post_thumbnail }}" class="card-img-top">
                            @endif
                        </a>
                        <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">{{ $post->post_title }}</a></h5>
                        <p>
                            <small class="text-muted">
                                oleh 
                                <a href="{{ route('posts.daftar') }}?author={{ $post->author->username }}" class="text-decoration-none text-muted">{{ $post->author->name??'-' }}</a>
                                 - {{ $post->created_at->diffForHumans() }}
                            </small>
                        </p>
                        <p class="card-text">{{ $post->post_short_content }}</p>
                        <a href="{{ route('posts.lihat',$post->post_slug) }}" class="btn btn-primary">Selengkapnya..</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    @else
        <p class="text-center fs-4">Tidak ada artikel</p>
    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-center">
                    {{ $posts->links('pagination::simple-bootstrap-4') }}
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
{{-- <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
@endpush