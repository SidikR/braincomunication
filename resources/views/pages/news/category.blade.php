@extends('pages.news.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li><a href={{ route('berita.index') }}>Home</a></li>
                <li class="current">Berita dengan kategori {{ $category_name }}</li>
            </ol>
        </div>
    </nav>
@endsection
@section('main')
    <div class="berita-terbaru">
        <p>Menampilkan berita untuk kategori "<b>{{ $category_name }}</b>"</p>
        <div class="row gy-4 posts-list">
            @if ($beritas->isEmpty())
                <p class="text-danger ">Tidak ada berita yang ditemukan.</p>
            @else
                @foreach ($beritas as $index => $berita)
                    <div class="col-lg-6">
                        <article class="rounded-4 ">

                            <div class="post-img" style="position: relative">
                                <div class="post-img-overlay">{{ $berita->kategori->name }}</div>
                                <img loading="lazy" src="{{ asset($berita->image) }}" alt="{{ $berita->alt_image }}"
                                    class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <h2 class="title mb-1">
                                <a href={{ route('berita.detail', [$berita->slug]) }}>
                                    @if (strlen($berita->title) > 60)
                                        {{ substr($berita->title, 0, 60) }}...
                                    @else
                                        {{ $berita->title }}
                                    @endif
                                </a>
                            </h2>

                            <div class="content mb-2 mt-0">
                                @if (strlen($berita->description) > 50)
                                    {{ substr($berita->description, 0, 50) }}...
                                @else
                                    {{ $berita->description }}
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-date">
                                        <span><i class="bi bi-clock-history"></i> <span
                                                id="resultCategory{{ $index }}"></span></span>
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list berita -->

                    <script script>
                        var givenDateCategory = '{{ $berita->published_at }}';
                        calculateDaysAgo(givenDateCategory, 'resultCategory{{ $index }}');
                    </script>
                @endforeach
                {{ $beritas->onEachSide(1)->links() }}
            @endif

        </div>
    </div>
@endsection
