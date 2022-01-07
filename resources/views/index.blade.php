@extends('layouts/app')

@section('title', '| Home')

@section('content')
<div class="container">
  <div class="row" data-aos="fade-up">
    <div class="col-xl-8 stretch-card grid-margin">
      <div class="position-relative">
        <div style="max-height: 820px; overflow:hidden;">
          <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-dark">
            <img
              src="{{ asset('uploads/' . $posts[0]->post_thumbnail) }}"
              alt="banner"
              class="img-fluid rounded"
            />
          </a>
        </div>
        @if ($posts[0]->tipe->post_type_slug=='video')
          <div style="top:50%; left:50%; position:absolute; transform:translate(-50%, -50%)">
            <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-danger"><i class="mdi mdi-youtube" style="font-size: 70px;" aria-hidden="true"></i></a>
          </div>
        @endif
        
        <div class="banner-content">
          <div class="badge badge-danger fs-12 font-weight-bold mb-3">
            <a href="{{ route('posts.daftar') }}?category={{ $posts[0]->kategori->category_slug }}" class="text-decoration-none text-white">{{ $posts[0]->kategori->category_name??'-' }}</a>
          </div>
          @php
            $pieces = explode(" ", $posts[0]->post_title);
            $first_part = implode(" ", array_splice($pieces, 0, 2));
            $other_part = implode(" ", array_splice($pieces, 2));
          @endphp 
          <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-white">
          {{-- <h1 class="mb-0">{{ $first_part }}</h1>
          <h1 class="mb-2">{{ $other_part }}</h1> --}}
          <h1>{{ $posts[0]->post_title }}</h1>
          
        </a>

          <div class="fs-12">
            <span class="mr-2"><a href="{{ route('posts.daftar') }}?author={{ $posts[0]->author->username }}" class="text-decoration-none text-white">{{ $posts[0]->author->name??'-' }}</a> </span>{{ $posts[0]->created_at->diffForHumans() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 stretch-card grid-margin">
      <div class="card bg-dark text-white">
        <div class="card-body">
          <h2>Berita Terbaru</h2>
          @foreach ($posts->take(3) as $post)
            <div class="d-flex border-bottom-blue py-3 align-items-center justify-content-between">
              <div class="pr-3">
                <h5><a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-white">{{ $post->post_title }}</a></h5>
                <div class="fs-12">
                  <span class="mr-2">{{ $post->tipe->post_type_name??'-' }} </span>{{ $post->created_at->diffForHumans() }}
                </div>
              </div>
              <div class="rotate-img">
              <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">
                    <img
                      src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                      alt="{{ $post->post_thumbnail }}"
                      class="img-fluid img-lg"
                    />
              </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="row" data-aos="fade-up">
    <div class="col-lg-3 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <h2>Kategori</h2>
          <ul class="list-group vertical-menu">
            @foreach ($categories as $item)
              <li><a href="{{ route('index') }}/home?selectedCategory={{ $item->category_slug }}" @if(request('selectedCategory')==$item->category_slug)style="text-decoration: none;color: #000000;font-weight: 600;" @endif >{{ $item->category_name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-9 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          @foreach ($postsByCategory->take(3) as $post)
          <div class="row">
            <div class="col-sm-4 grid-margin">
              <div class="position-relative">
                <div class="rotate-img">
                <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">
                    <img
                      src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                      alt="thumb"
                      class="img-fluid"
                    />
                </a>
                </div>
                <div class="badge-positioned">
                  <span class="badge badge-danger font-weight-bold"><a href="{{ route('posts.daftar') }}?category={{ $post->kategori->category_slug }}" class="text-decoration-none text-white">{{ $post->kategori->category_name }}</a></span>
                </div>
              </div>
            </div>
            <div class="col-sm-8  grid-margin">
              <h2 class="mb-2 font-weight-600">
                <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">{{$post->post_title}}</a>
              </h2>
              <div class="fs-13 mb-2">
                <span class="mr-2">{{ $post->tipe->post_type_name }} </span>{{ $post->created_at->diffForHumans() }}
              </div>
              <p class="mb-0">
                {{$post->post_short_content}}
              </p>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
  <div class="row" data-aos="fade-up">
    <div class="col-sm-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-title">
                Video
              </div>
              <div class="row">
                @foreach ($posts->where('post_type',3)->take(4) as $post)
                  <div class="col-sm-6 grid-margin">
                    <div class="position-relative">
                      <div class="rotate-img">
                        <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">
                        <img
                          src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                          alt="thumb"
                          class="img-fluid"
                        />
                      </a>
                      </div>
                      <div class="badge-positioned w-90">
                        <div class="d-flex justify-content-between align-items-center">
                          <span class="badge badge-danger font-weight-bold"><a href="{{ route('posts.daftar') }}?category={{ $post->kategori->category_slug }}" class="text-decoration-none text-white">{{ $post->kategori->category_name }}</a></span>
                          <div class="video-icon">
                            <i class="mdi mdi-play"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-lg-4">
              <div
                class="d-flex justify-content-between align-items-center">
                <div class="card-title">
                  Video Terbaru
                </div>
                <p class="mb-3"><a href="{{ route('posts.daftar') }}" class="text-decoration-none text-dark">Lihat Semua</a></p>
              </div>
              @foreach ($posts->where('post_type',3)->skip(4)->take(6) as $post)
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                  <div class="div-w-80 mr-3">
                    <div class="rotate-img">
                      <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">
                        <img
                          src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                          alt="thumb"
                          class="img-fluid"
                        />
                      </a>
                    </div>
                  </div>
                  <h3 class="font-weight-600 mb-0">
                    <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">{{ substr($post->post_title,0,30) . '...' }}</a>
                  </h3>
                </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" data-aos="fade-up">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6">
              <div class="card-title">
                Paling Popular
              </div>
              <div class="row">
                <div class="col-xl-6 col-lg-8 col-sm-6">
                  <div class="rotate-img">
                    <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-dark">
                      <img
                        src="{{ asset('uploads/' . $posts[0]->post_thumbnail) }}"
                        alt="thumb"
                        class="img-fluid"
                      />
                    </a>
                  </div>
                  <h2 class="mt-3 text-primary mb-2">
                    <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="text-decoration-none text-dark">{{ $posts[0]->post_title }}</a>
                  </h2>
                  <p class="fs-13 mb-1 text-muted">
                    <span class="mr-2">{{ $posts[0]->tipe->post_type_name }} </span>{{ $posts[0]->created_at->diffForHumans() }}
                  </p>
                  <p class="my-3 fs-15">
                    {{ $posts[0]->post_short_content }}
                  </p>
                  <a href="{{ route('posts.lihat',$posts[0]->post_slug) }}" class="font-weight-600 fs-16 text-dark">Selengkapnya</a>
                </div>

                <div class="col-xl-6 col-lg-4 col-sm-6">
                  @foreach ($popular_posts->skip(1) as $post)
                    <div class="border-bottom pb-3 mb-3">
                      <h3 class="font-weight-600 mb-0">
                        <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">{{ substr($post->post_title,0,20) . '...' }}</a>
                      </h3>
                      <p class="fs-13 text-muted mb-0">
                        <span class="mr-2">{{ $post->tipe->post_type_name }} </span>{{ $post->created_at->diffForHumans() }}
                      </p>
                      <p class="mb-0">
                        {{-- {{ explode(" ",$post->post_short_content,6) }} --}}
                        {{ substr($post->post_short_content,0,50) . ' ..' }}
                      </p>
                    </div>
                  @endforeach
                  
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="row">
                <div class="col-sm-6">
                  <div class="card-title">
                    Foto Terbaru
                  </div>
                  @foreach ($posts->where('post_type',3)->take(2) as $post)
                  @php
                      $pieces = explode(" ", $post->post_title);
                      $first_part = implode(" ", array_splice($pieces, 0, 4));
                      $other_part = implode(" ", array_splice($pieces, 4));
                  @endphp 
                    <div class="border-bottom pb-3">
                      <div class="rotate-img">
                        <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">
                          <img
                            src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                            alt="thumb"
                            class="img-fluid"
                          />
                        </a>
                      </div>
                      <p class="fs-16 font-weight-600 mb-0 mt-3">
                        <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">{{ $post->author->name }}: {{ $first_part }}</a>
                      </p>
                      <p class="fs-13 text-muted mb-0">
                        <span class="mr-2">{{ $post->tipe->post_type_name }} </span>{{ $post->created_at->diffForHumans() }}
                      </p>
                    </div>
                  @endforeach
                  
                </div>
                <div class="col-sm-6">
                  <div class="card-title">
                    Popular Post
                  </div>
                  @foreach ($posts->where('post_type',2)->take(5) as $post)
                  @php
                      $judul = explode(" ", $post->post_title);
                      $judul_pertama = implode(" ", array_splice($judul, 0, 2));
                      $isi = explode(" ", $post->post_title);
                      $isi_pertama = implode(" ", array_splice($isi, 0, 4));
                  @endphp 

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="border-bottom pb-3">
                        <div class="row">
                          <div class="col-sm-5 pr-2">
                            <div class="rotate-img">
                              <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">
                                <img
                                  src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                                  alt="thumb"
                                  class="img-fluid w-100"
                                />
                              </a>
                            </div>
                          </div>
                          <div class="col-sm-7 pl-2">
                            <p class="fs-16 font-weight-600 mb-0">
                              <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-dark">{{ $judul_pertama }}</a>
                            </p>
                            <p class="fs-13 text-muted mb-0">
                              <span class="mr-2">{{ $post->tipe->post_type_name }} </span>{{ $post->created_at->diffForHumans() }}
                            </p>
                            <p class="mb-0 fs-13">
                              {{ $isi_pertama }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection