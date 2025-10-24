@extends('pages.news.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li><a href={{ route('berita.index') }}>Berita</a></li>
                <li class="current">Berita dengan kata kunci "{{ $keyword }}"</li>
            </ol>
        </div>
    </nav>
@endsection
@section('main')
    <div class="berita-terbaru">
        <p>Hasil Pencarian untuk "<b>{{ $keyword }}</b>"</p>
        <div class="row gy-4 posts-list">
            @if ($beritas->isEmpty())
                <p class="text-danger ">Tidak ada berita yang ditemukan.</p>
            @else
                @foreach ($beritas as $index => $item)
                    <div class="col-lg-6">
                        <article>

                            <div class="post-img" style="position: relative">
                                <div class="post-img-overlay">{{ $item->kategori->name }}</div>
                                <img loading="lazy" src="{{ asset($item->image) }}" alt="{{ $item->alt_image }}"
                                    class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

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
                                                id="resultSearch{{ $index }}"></span></span>
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->

                    <script script>
                        var givenDateSearch = '{{ $item->published_at }}';
                        calculateDaysAgo(givenDateSearch, 'resultSearch{{ $index }}');
                    </script>
                @endforeach
                {{ $beritas->onEachSide(1)->links() }}
            @endif

        </div>
    </div>
@endsection
