@extends('pages.testimoni.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li class="current">Testimoni</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    {{-- Testimoni Stakeholder --}}
    <div class="testi-section mb-5">
        <div class="testi-section-header text-center mb-4" data-aos="fade-up">
            <span class="testi-label">Apa Kata Mereka</span>
            <h2 class="testi-section-title">Testimoni Stakeholder</h2>
            <div class="testi-divider mx-auto"></div>
        </div>

        @if ($testimoniStakeholder->isEmpty())
            <div class="text-center py-5" data-aos="fade-up">
                <i class="bi bi-chat-square-quote fs-1 text-muted"></i>
                <p class="text-muted mt-2">Belum ada testimoni stakeholder.</p>
            </div>
        @else
            <div class="row gy-4 justify-content-center">
                @foreach ($testimoniStakeholder as $item)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="testi-card h-100">
                            <div class="testi-quote-bg">
                                <i class="bi bi-quote"></i>
                            </div>
                            <div class="testi-stars mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="testi-message">{{ $item->pesan }}</p>
                            <div class="testi-author">
                                <img src="{{ asset($item->image) }}" class="testi-avatar" alt="{{ $item->nama }}">
                                <div class="testi-author-info">
                                    <h5 class="testi-name">{{ $item->nama }}</h5>
                                    <span class="testi-position">{{ $item->posisi }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Testimoni Sahabat --}}
    <div class="testi-section">
        <div class="testi-section-header text-center mb-4" data-aos="fade-up">
            <span class="testi-label">Komunitas Kami</span>
            <h2 class="testi-section-title">Testimoni Sahabat</h2>
            <div class="testi-divider mx-auto"></div>
        </div>

        @if ($testimoniSahabat->isEmpty())
            <div class="text-center py-5" data-aos="fade-up">
                <i class="bi bi-chat-square-quote fs-1 text-muted"></i>
                <p class="text-muted mt-2">Belum ada testimoni sahabat.</p>
            </div>
        @else
            <div class="row gy-4 justify-content-center">
                @foreach ($testimoniSahabat as $item)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="testi-card h-100">
                            <div class="testi-quote-bg">
                                <i class="bi bi-quote"></i>
                            </div>
                            <div class="testi-stars mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="testi-message">{{ $item->pesan }}</p>
                            <div class="testi-author">
                                <img src="{{ asset($item->image) }}" class="testi-avatar" alt="{{ $item->nama }}">
                                <div class="testi-author-info">
                                    <h5 class="testi-name">{{ $item->nama }}</h5>
                                    <span class="testi-position">{{ $item->posisi }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .testi-section-header .testi-label {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--primary-color);
        }

        .testi-section-title {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--heading-color, #2d2d2d);
            margin-top: 6px;
            margin-bottom: 12px;
        }

        .testi-divider {
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .testi-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px 28px 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .testi-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.13);
        }

        .testi-quote-bg {
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 72px;
            line-height: 1;
            color: rgba(var(--primary-color-rgb), 0.08);
            pointer-events: none;
            user-select: none;
        }

        .testi-stars i {
            color: #ffc107;
            font-size: 14px;
            margin-right: 2px;
        }

        .testi-message {
            font-size: 0.92rem;
            line-height: 1.7;
            color: #555;
            font-style: italic;
            flex: 1;
            margin-bottom: 20px;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 12px;
            border-top: 1px solid #f0f0f0;
            padding-top: 16px;
            margin-top: auto;
        }

        .testi-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            flex-shrink: 0;
        }

        .testi-name {
            font-size: 0.95rem;
            font-weight: 700;
            margin: 0 0 2px;
            color: var(--heading-color, #2d2d2d);
        }

        .testi-position {
            font-size: 0.78rem;
            color: var(--primary-color);
            font-weight: 500;
        }
    </style>
@endsection
