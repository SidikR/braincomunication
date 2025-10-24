@extends('pages.news.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li><a href={{ route('berita.index') }}>Berita</a></li>
                <li class="current">{{ $berita->title }}</li>
            </ol>
        </div>
    </nav>
@endsection
@section('main')
    <div class="row mt-2">
        {{-- <div class="col-lg-3" id="iklan-space">
            <div class="sidebar rounded-4 ">
                <div class="sidebar-item search-form">
                    <h3 class="sidebar-title">Iklan Space</h3>
                </div>
            </div>
        </div> --}}

        <div class="news-space" id="news-space">
            <article class="article rounded-4">

                <figure class="post-img mb-1" style="position: relative">
                    <div class="post-img-overlay">{{ $berita->kategori->name }}</div>
                    <img loading="lazy" src="{{ asset($berita->image) }}" alt="{{ $berita->alt_image }}"
                        class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                </figure>
                <figcaption class="figure-caption text-start m-0 p-0">
                    {{ $berita->description_thumbnail }}
                </figcaption>

                <h2 class="title">{{ $berita->title }}</h2>

                <div class="meta-top">
                    <ul class="d-flex flex-column flex-md-row ">
                        <li><i class="text-center bi bi-person"></i> <a class="d-flex align-items-center "
                                href="#">{{ $berita->writer->name }}</a></li>
                        <li class=""><i class="bi bi-clock"></i> <a href="#"><time
                                    datetime="{{ $berita->published_at }}"><span id="resultTimeHuman"></span></time></a>
                        </li>
                        <li class=""><i class="bi bi-eye"></i> <a href="#">{{ $berita->count_of_viewers }}x
                                dilihat</a></li>
                    </ul>
                </div><!-- End meta top -->

                <hr>

                <div class="content">{!! $berita->content !!}</div><!-- End post content -->

                <div class="meta-bottom">
                    <i class="bi bi-folder"></i>
                    <ul class="cats">
                        <li><a href="#">{{ $berita->kategori->name }}</a></li>
                    </ul>

                    <i class="bi bi-tags"></i>
                    @php
                        // Memecah string tag menjadi array
                        $tagsArray = explode(',', $berita->tag);
                    @endphp

                    <ul class="tags">
                        @foreach ($tagsArray as $tag)
                            @php
                                $cleanTag = trim($tag);
                            @endphp
                            <li class="tag-news"><a
                                    href="{{ route('berita.search', ['keyword' => $cleanTag]) }}">{{ $cleanTag }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tombol Berbagi -->
                <div class="share-buttons d-flex flex-column justify-content-center align-items-center p-0 mt-5 gap-0">
                    <span class="m-0 mb-1">Share On : </span>
                    <div class="button d-flex gap-1 justify-content-center align-items-center ">
                        <button class="btn btn-copy-link btn-share-content btn-sm" title="Copy Link"><i
                                class="bi bi-copy"></i></button>

                        <a class="btn btn-share-content btn-sm"
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                            role="button" target="_blank"><i class="bi bi-facebook" title="Share on Facebook"></i></a>

                        <a class="btn btn-share-content btn-sm"
                            href="whatsapp://send?text={{ $berita->title }}:%20{{ urlencode(Request::fullUrl()) }}"
                            role="button" target="_blank" title="Share on Whatssapp"><i class="bi bi-whatsapp"></i></a>

                        <span>Atau</span>

                        <button class="btn btn-share btn-share-content btn-sm" title="Share Anywhere ..."><i
                                class="bi bi-share"></i></button>
                    </div>
                </div><!-- End share buttons -->
            </article>
        </div>

    </div>

    <script script>
        var givenDate = '{{ $berita->published_at }}';
        calculateDaysAgo(givenDate, 'resultTimeHuman');
    </script>

    {{-- <script>
        const iklanSpace = document.getElementById('iklan-space');
        const newsSpace = document.getElementById('news-space');
        const iklanSpaceVisible = false;
        if (!iklanSpaceVisible) {
            iklanSpace.style.display = 'none'; // Sembunyikan iklan-space
            newsSpace.classList.remove('col-lg-7'); // Hapus class col-lg-7
            newsSpace.classList.add('col-lg-12'); // Tambah class col-lg-9
        }
    </script> --}}
@endsection
