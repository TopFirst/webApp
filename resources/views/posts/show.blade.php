@extends('layouts/app')

@push('css')
      <!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
/* Style all font awesome icons */
.fa {
  padding: 10px;
  font-size: 15px;
  width: 70px;
  text-align: center;
  text-decoration: none;
}

.fa-bulat {
  width: 35px;
  border-radius: 50%;
}

/* Add a hover effect if you want */
.fa:hover {
  opacity: 0.7;
  text-decoration: none;

}

/* Set a specific color for each brand */

/* Facebook */
.fa-facebook {
  background: #3B5998;
  color: white;
}

/* Twitter */
.fa-twitter {
  background: #55ACEE;
  color: white;
}

/* whatsapp*/
.fa-whatsapp {
  background: #075e54;
  color: white;
}
  </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-left mb-5">
        <div class="col-md-8">
            <span class="badge bg-secondary text-white"><a href="{{ route('posts.daftar') }}?category={{ $post->kategori->category_slug }}" class="text-decoration-none text-white">{{ $post->kategori->category_name??'-' }}</a></span>
            <h1 class="mb-3">{{ $post->post_title }}</h1>
            <p> Penulis 
                <a href="{{ route('posts.daftar') }}?author={{ $post->author->username }}" class="text-decoration-none text-dark">{{ $post->author->name??'-' }}</a>
                 - {{ $post->created_at->diffForHumans() }}
            </p>

            @if ($post->post_thumbnail)
            <div style="max-height:350px; overflow:hidden;">
                <img src="{{ asset('uploads/' . $post->post_thumbnail) }}" alt="{{ $post->post_thumbnail }}" class="img-fluid">
            </div>
            @else
                <img src="https://source.unsplash.com/120x400?{{ $post->kategori->category_name }}" alt="{{ $post->post_thumbnail }}" class="img-fluid">
            @endif

            <article class="my-3 fs-4">
                {!! $post->post_content !!}
            </article>
        <hr>
        <a href="#" class="btn btn-primary"><i class="mdi mdi-thumb-up p-0"></i> Like 0</a> 
        <div class="form-group float-right">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.lihat',$post->post_slug) }}" class="fa fa-bulat fa-facebook"></a>
          <a href="https://www.twitter.com/share?url={{ route('posts.lihat',$post->post_slug) }}" class="fa fa-bulat fa-twitter"></a>
          <a href="https://wa.me/?text={{ route('posts.lihat',$post->post_slug) }}" class="fa fa-bulat fa-whatsapp"></a>
        </div>
        <hr>
        </div>
            <div class="col-md-4">
                @if ($posts->count())
                <div class="container">
                    <h2>Artikel Terbaru</h2>
                    <div class="row">
                        <div class="col-md-12">
                          <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-dark">
                            @if ($posts[0]->post_thumbnail)
                                <img src="{{ asset('uploads/' . $posts[0]->post_thumbnail) }}" alt="{{ $posts[0]->post_thumbnail }}" class="card-img-top">
                            @else
                                <img src="https://source.unsplash.com/500x400?{{ $posts[0]->kategori->category_name }}" alt="{{ $posts[0]->post_thumbnail }}" class="card-img-top">
                            @endif
                          </a>
                            <h3 class="mb-0"><a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-dark">{{ $posts[0]->post_title }}</a></h3>

                            <p class="fs-12 text-muted mb-0">
                                <span class="">
                                    <a href="{{ route('posts.daftar') }}?author={{ $posts[0]->author->username }}" class="text-decoration-none text-muted">{{ $posts[0]->author->name??'-' }}</a>
                                    - {{ $posts[0]->created_at->diffForHumans() }}
                                </span>
                            </p>
                            <p class="mt-0 mb-2">{{ $posts[0]->post_short_content }}</p>
                    </div>
                            
                    </div>
                    @foreach ($posts->skip(1)->take(4) as $post)
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