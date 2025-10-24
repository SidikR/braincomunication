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
    <div class="row gap-3 d-flex justify-content-center">
        <h1 class="text-center">Testimoni Stakeholder</h1>
        @forelse ($testimoniStakeholder as $item)
            <div class="col-12 col-lg-3">
                <section id="testimonials" class="testimonials rounded-4 row bg-whie">
                    <div class="testimonial-item p-3 rounded-4">
                        <div class="d-flex">
                            <img src="{{ asset($item->image) }}" class="testimonial-img flex-shrink-0" alt="">
                            <div>
                                <h3>{{ $item->nama }}</h3>
                                <h4>{{ $item->posisi }}</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ $item->pesan }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </section><!-- End Testimonials Section -->
            </div>
        @empty
        <h3 class="text-danger text-center">Tidak Ada Data</h3>
        @endforelse
    </div>

    {{-- Testimoni Sahabat --}}
    <div class="row gap-3 d-flex justify-content-center mt-5">
        <h1 class="text-center">Testimoni Sahabat</h1>
        @forelse ($testimoniSahabat as $item)
            <div class="col-12 col-lg-3">
                <section id="testimonials" class="testimonials rounded-4 row bg-whie">
                    <div class="testimonial-item p-3 rounded-4">
                        <div class="d-flex">
                            <img src="{{ asset($item->image) }}" class="testimonial-img flex-shrink-0" alt="">
                            <div>
                                <h3>{{ $item->nama }}</h3>
                                <h4>{{ $item->posisi }}</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ $item->pesan }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </section><!-- End Testimonials Section -->
            </div>
        @empty
        <h3 class="text-danger text-center">Tidak Ada Data</h3>
        @endforelse
    </div>
@endsection
