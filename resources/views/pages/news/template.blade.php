@extends('layouts.main')
@section('content')
    <div data-aos="fade" class="page-title mb-0 pb-0">
        <div class="heading"
            style="background-image: url({{ asset('storage/image/banner.webp') }}); background-size: fit; background-position: center; height: 300px">
            <div class="overlay"></div>
            <div class="container">
                <div class="container section-title detail mt-5 d-flex flex-column" data-aos="fade-up">
                    <h2 class="text-white">{{ $heading['h2'] }}</h2>
                    <p class="text-white">{{ $heading['p'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="page-title">
        <div class="heading p-0">
            @yield('breadcrumbs')
        </div>
    </div>

    <section id="blog-details" class="blog-details pt-3">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-1">
                <div class="col-lg-8 mt-0">
                    <section id="blog" class="blog pt-3">
                        <div class="container" data-aos="fade-up" data-aos-delay="100">
                            @yield('main')
                        </div>
                    </section>
                </div>

                <div class="col-lg-4 mt-4">
                    <div class="sidebar p-3 rounded-4">

                        <div class="sidebar-item search-form">
                            <h3 class="sidebar-title">Search</h3>
                            <form action="{{ route('berita.search') }}" method="GET" class="mt-3">
                                <input type="text" name="keyword" placeholder="Cari berita..." required
                                    value="{{ request()->input('keyword') }}">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search form -->

                        <div class="sidebar-item categories">
                            <h3 class="sidebar-title">Kategori Berita</h3>
                            <ul class="mt-3">
                                @foreach (getCategories() as $item)
                                    <li><a href="{{ route('berita.category', [$item->slug]) }}">{{ $item->name }}
                                            <span>({{ $item->berita_count }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->

                        <div class="sidebar-item year categories mb-3">
                            @php
                                $bulanTahun = getMonthAndYear();
                            @endphp
                            <h3 class="sidebar-title">Arsip Berita</h3>
                            <ul class="mt-3">

                                <div class="mb-3">
                                    <select class="form-select form-select-sm" id="bulanTahun" onchange="redirectToArsip()">
                                        <option selected disabled>Pilih Bulan</option>
                                        @foreach ($bulanTahun as $item)
                                            <option value="{{ $item['bulan'] . '-' . $item['tahun'] }}">
                                                {{ date('F', mktime(0, 0, 0, $item['bulan'], 1)) . ' ' . $item['tahun'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </ul>
                        </div>

                        <script>
                            function redirectToArsip() {
                                var selectedValue = document.getElementById('bulanTahun').value;
                                if (selectedValue) {
                                    var baseUrl = window.location.origin;
                                    window.location.href = baseUrl + "/berita/arsip/" + selectedValue;
                                }
                            }
                        </script>

                        <div class="sidebar-item year categories">
                            <h3 class="sidebar-title">Tahun Berita</h3>
                            <ul class="mt-3">
                                @foreach (getCountBeritaByYear() as $item)
                                    <li><a href="{{ route('berita.year', [$item->year]) }}">{{ $item->year }}
                                            <span>({{ $item->count }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->


                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Berita Terbaru</h3>
                            @if ($berita_terbaru == null)
                                <div class="col-lg-12">
                                    <p>Tidak ada berita terbaru saat ini.</p>
                                </div>
                            @else
                                @foreach (getBeritaTerbaru() as $index => $item)
                                    <div class="post-item">
                                        <figure style="height: 100px; width: 150px; min-width: 150px" class="pe-2">
                                            <img loading="lazy" src="{{ asset($item->image) }}"
                                                alt="{{ $item->alt_image }}"
                                                class="flex-shrink-0 h-100 w-100 object-fit-cover rounded-3">
                                        </figure>
                                        <div>
                                            <h4><a
                                                    href={{ route('berita.detail', [$item->slug]) }}>{{ $item->title }}</a>
                                            </h4>
                                            <time datetime="{{ $item->updated_at }}"><span
                                                    id="result{{ $index }}"></span></time>
                                        </div>
                                    </div><!-- End recent post item-->
                                    <script script>
                                        var givenDate = '{{ $item->published_at }}';
                                        calculateDaysAgo(givenDate, 'result{{ $index }}');
                                    </script>
                                @endforeach
                            @endif

                        </div><!-- End sidebar recent posts-->

                        <div class="sidebar-item tags">
                            <h3 class="sidebar-title">Semua Tag</h3>
                            <ul class="mt-3" id="tagList">
                                <!-- Data tag akan dirender di sini -->
                            </ul>
                        </div><!-- End sidebar tags-->

                        <div id="tagPagination">
                            <!-- Pagination akan dirender di sini -->
                        </div>

                        <script>
                            $(document).ready(function() {
                                loadTags();
                            });

                            function loadTags(page = 1) {
                                $.ajax({
                                    url: "{{ route('tags') }}?page=" + page,
                                    success: function(data) {
                                        renderTags(data.data);
                                        console.log(data);
                                        renderPagination(data.links);
                                    },
                                    error: function(xhr) {
                                        // Handle error
                                    }
                                });
                            }

                            function renderTags(tags) {
                                var tagList = $('#tagList');
                                tagList.empty();
                                $.each(tags, function(index, tag) {
                                    tagList.append('<li><a href="{{ route('berita.tag') }}?tag=' + tag + '">' + tag + '</a></li>');
                                });
                            }

                            function renderPagination(data) {
                                var pagination = $('#tagPagination');
                                pagination.empty();
                                pagination.append(data);
                            }

                            $(document).on('click', '#tagPagination a', function(e) {
                                e.preventDefault();
                                var page = $(this).attr('href').split('page=')[1];
                                loadTags(page);
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
