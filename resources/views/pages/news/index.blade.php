@extends('pages.news.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li class="current">Berita</li>
            </ol>
        </div>
    </nav>
@endsection
@section('main')
    <div class="kegiatan-seru mt-3">
        <h2 class="fw-bold text-center mb-3">Kegiatan Seru</h2>
        <div class="row gy-4 posts-list">
            @if ($berita_kegiatan_seru->isEmpty())
                <div class="col-lg-12 text-danger">
                    <p>Tidak ada berita terpopuler saat ini.</p>
                </div>
            @else
                @foreach ($berita_kegiatan_seru as $index => $item)
                    <div class="col-lg-6">
                        <article class="rounded-4">

                            <figure class="post-img" style="position: relative">
                                <div class="post-img-overlay">{{ $item->kategori->name }}</div>
                                <img loading="lazy" src="{{ $item->image }}" alt="{{ $item->alt_image }}"
                                    class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                            </figure>

                            <h2 class="title mb-1">
                                <a href={{ route('berita.detail', [$item->slug]) }}>
                                    @if (strlen($item->title) > 60)
                                        {{ substr($item->title, 0, 60) }}...
                                    @else
                                        {{ $item->title }}
                                    @endif
                                </a>
                            </h2>

                            <div class="content mb-2 mt-0">
                                @if (strlen($item->description) > 50)
                                    {{ substr($item->description, 0, 50) }}...
                                @else
                                    {{ $item->description }}
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-date">
                                        <span><i class="bi bi-eye"></i> {{ $item->count_of_viewers }}x dilihat</span>
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->
                @endforeach
                {{ $berita_kegiatan_seru->onEachSide(1)->links() }}
            @endif

        </div>
    </div>

    <hr>

    <div class="berita-terbaru">
       <h2 class="fw-bold text-center mb-3">Berita Terbaru</h2>
        <div class="row gy-4 posts-list">
            @if ($berita_terbaru->isEmpty())
                <div class="col-lg-12 text-danger">
                    <p>Tidak ada berita terbaru saat ini.</p>
                </div>
            @else
                @foreach ($berita_terbaru as $index => $item)
                    <div class="col-lg-6">
                        <article class="rounded-4 article-card">

                            <figure class="post-img" style="position: relative">
                                <div class="post-img-overlay">{{ $item->kategori->name }}</div>
                                <img loading="lazy" src="{{ asset($item->image) }}" alt="{{ $item->alt_image }}"
                                    class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                            </figure>

                            <h2 class="title mb-1">
                                <a href={{ route('berita.detail', [$item->slug]) }}>
                                    @if (strlen($item->title) > 60)
                                        {{ substr($item->title, 0, 60) }}...
                                    @else
                                        {{ $item->title }}
                                    @endif
                                </a>
                            </h2>

                            <div class="content mb-2 mt-0">
                                @if (strlen($item->description) > 50)
                                    {{ substr($item->description, 0, 50) }}...
                                @else
                                    {{ $item->description }}
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-date">
                                        <span><i class="bi bi-clock-history"></i> <span
                                                id="results{{ $index }}"></span></span>
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->

                    <script script>
                        var givenDatenewst = '{{ $item->published_at }}';
                        calculateDaysAgo(givenDatenewst, 'results{{ $index }}');
                    </script>
                @endforeach
                {{ $berita_terbaru->onEachSide(1)->links() }}
            @endif
        </div>
    </div>

@endsection
