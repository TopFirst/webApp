@extends('layouts/app')
@section('title', '| Semua Kategori')
@section('content')
<div class="container">
    <h1 class="mb-3">Daftar Kategori</h1>

    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-3 mb-3">
                <a href="{{ route('posts.daftar') }}?category={{ $category->category_slug }}">
                    <div class="card bg-dark text-white">
                        <img src="{{ asset('uploads/' . $category->thumbnail) }}" alt="{{ $category->category_slug }}" class="card-img">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $category->category_name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection