@extends('layouts/app')

@section('title', '| Artikel Detail')

@section('content')
<div class="container">
    <div class="row justify-content-left mb-5">
        <div class="col-md-8">
            @if ($post->details()->exists())
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ $post->details[0]->item_content }}" frameborder="0" allowfullscreen=""></iframe>
                </div>
            @else
                <small class="text text-muted">Artikel ini tidak mempunyai video</small>
            @endif

            <h1 class="mb-3 mt-2">{{ $post->post_title }}</h1>
            <p> Penulis 
                <a href="{{ route('posts.daftar') }}?author={{ $post->author->username }}" class="text-decoration-none text-dark">{{ $post->author->name??'-' }}</a>
                 - {{ $post->created_at->diffForHumans() }}
                <span class="badge bg-secondary text-white float-right"><a href="{{ route('posts.daftar') }}?category={{ $post->kategori->category_slug }}" class="text-decoration-none text-white">{{ $post->kategori->category_name??'-' }}</a></span>

            </p>

            <article class="my-3 fs-4">
                {!! $post->post_content !!}
            </article>
        
            <a href="{{ route('posts.daftar') }}" class="d-block mt-3"><i class="fa fa-angle-left"></i> Kembali ke Daftar Artikel</a>
        </div>
            <div class="col-md-4">
                @if ($posts->count())
                <div class="container">
                    <h2>Video Terbaru</h2>
                    
                    @foreach ($posts->where('id','<>',$post->id)->take(7) as $post)
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="border-bottom pb-3">
                            <div class="row">
                              <div class="col-sm-5 pr-2">
                                <div class="rotate-img">
                                    <a href="{{ route('posts.lihat',$post->post_slug) }}" class="fs-16 font-weight-600 mb-0 text-decoration-none text-dark">
                                        <img
                                            src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                                            alt="{{ $post->post_thumbnail }}"
                                            class="img-fluid w-100"
                                        />
                                    </a>
                                </div>
                              </div>
                              <div class="col-sm-7 pl-2">
                                <a href="{{ route('posts.lihat',$post->post_slug) }}" class="fs-16 font-weight-600 mb-0 text-decoration-none text-dark">
                                  {{ $post->post_title }}
                                </a>
                                <p class="fs-12 text-muted mb-0">
                                  <span class="mr-2"><a href="{{ route('posts.daftar') }}?category={{ $post->kategori->category_slug }}" class="text-decoration-none text-muted">{{ $post->kategori->category_name??'-' }}</a></span>{{ $post->created_at->diffForHumans() }}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach

                </div>
                @else
                <p>No Articles</p>
                @endif
            </div>
    </div>
</div>
@endsection