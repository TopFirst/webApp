@extends('layouts/app')

@section('title', '| Show')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <h1 class="mb-3">{{ $page->title }}</h1>
            <article class="my-3 fs-4">
                {!! $page->content !!}
            </article>
            <p> Oleh : 
                <a href="#" class="text-decoration-none text-dark">{{ $page->author->name??'-' }}</a>
                 - {{ $page->created_at->diffForHumans() }}
            </p>
        </div>
    </div>
</div>
@endsection