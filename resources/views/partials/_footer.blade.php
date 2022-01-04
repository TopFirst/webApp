<footer>
          <div class="footer-top">
            <div class="container">
              <div class="row">
                <div class="col-sm-5">
                  <img src="{{ asset('app/images/logo.png')  }}" class="footer-logo" alt="" />
                  <ul class="list-unstyled mt-3 mb-4">
                    {{-- <li>Lembaga Adat Melayu</li>
                    <li>Kota Batam</li>
                    <br>
                    <li>Jl. Engku Putri No. 20, Batam Center</li>
                    <li>Kel. Belian - Batam</li> --}}
                    {!! $web_configs->where('slug','contact')->first()->opt_value !!}
                    <br>
                    <li>Email : <a href="mailto:{{ $web_configs->where('slug','email')->first()->opt_value }}">{{ $web_configs->where('slug','email')->first()->opt_value }}</a></li>
                  </ul>
                  <ul class="social-media mb-3">
                    <li>
                      <a href="#">
                        <i class="mdi mdi-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="mdi mdi-youtube"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="mdi mdi-twitter"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-4">
                  <h3 class="font-weight-bold mb-3">BERITA TERBARU</h3>
                  @foreach ($posts->take(5) as $post)
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="footer-border-bottom pb-2">
                          <div class="row">
                            <div class="col-3">
                              <img
                                src="{{ asset('uploads/' . $post->post_thumbnail) }}"
                                alt="thumb"
                                class="img-fluid"
                              />
                            </div>
                            <div class="col-9">
                              <h5 class="font-weight-600">
                                <a href="{{ route('posts.lihat',$post->post_slug) }}" class="text-decoration-none text-white">{{$post->post_title}}</a>
                              </h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach

                </div>
                <div class="col-sm-3">
                  <h3 class="font-weight-bold mb-3">KATEGORI</h3>
                  @foreach ($categories as $cat)
                    <div class="footer-border-bottom pb-2">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 font-weight-600"><a href="{{ route('posts.daftar') }}?category={{ $cat->category_slug }}" class="text-decoration-none text-white">{{ $cat->category_name??'-' }}</a></h5>
                        <div class="count">{{ $cat->post_count }}</div>
                      </div>
                    </div>
                  @endforeach
                  
                </div>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="d-sm-flex justify-content-between align-items-center">
                    <div class="fs-14 font-weight-600">
                      {{-- © 2021 @ <a href="https://www.aoksinergi.com/" target="_blank" class="text-white"> Aok</a>. All rights reserved. --}}
                      {{-- Lembaga Adat Melayu Kota Batam --}}
                      {{ $web_configs->where('slug','footer_name')->first()->opt_value }}
                    </div>
                    <div class="fs-14 font-weight-600">
                      Copyright © 2021 by <a href="https://www.aoksinergi.com/" target="_blank" class="text-white">Aok</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer>
