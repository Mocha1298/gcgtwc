@extends('layout')
@section('title', 'Dashboard')
@section('home', 'active')
@section('link1', '#')
@section('d-aspek', '/aspek')
@section('d-indikator', '/indikator')
@section('d-parameter', '/parameter')
@section('d-faktor', '/faktor')
@section('d-sub', '/sub')
@section('link3', '/user')
@section('link4', '/report')
@section('greeting')
    <h1>Parameter <span class="tahun">({{$tahun}})</span></h1>
@endsection

@section('css')
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="/assets/css/core/libs.min.css" />

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="/assets/vendor/aos/dist/aos.css" />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="/assets/css/hope-ui.min.css?v=2.0.0" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="/assets/css/custom.min.css?v=2.0.0" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="/assets/css/dark.min.css" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="/assets/css/customizer.min.css" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="/assets/css/rtl.min.css" />
@endsection

@section('script')
    <!-- Library Bundle Script -->
    <script src="/assets/js/core/libs.min.js"></script>

    <!-- External Library Bundle Script -->
    <script src="/assets/js/core/external.min.js"></script>

    <!-- Widgetchart Script -->
    <script src="/assets/js/charts/widgetcharts.js"></script>

    <!-- mapchart Script -->
    <script src="/assets/js/charts/vectore-chart.js"></script>
    <script src="/assets/js/charts/dashboard.js"></script>

    <!-- fslightbox Script -->
    <script src="/assets/js/plugins/fslightbox.js"></script>

    <!-- Settings Script -->
    <script src="/assets/js/plugins/setting.js"></script>

    <!-- Slider-tab Script -->
    <script src="/assets/js/plugins/slider-tabs.js"></script>

    <!-- Form Wizard Script -->
    <script src="/assets/js/plugins/form-wizard.js"></script>

    <!-- AOS Animation Plugin-->
    <script src="/assets/vendor/aos/dist/aos.js"></script>

    <!-- App Script -->
    <script src="/assets/js/hope-ui.js" defer></script>
@endsection

@section('main')
    {{-- <h1>{{ Auth::user()->role }}</h1> --}}
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        @if (Auth::user()->role == 'Admin')
                            @foreach ($aspek as $a)
                                @php
                                    $warna = 'danger';
                                    if ($a->skor > 75) {
                                        $warna = 'success';
                                    } elseif ($a->skor < 75 and $a->skor > 60) {
                                        $warna = 'warning';
                                    } elseif ($a->skor < 60 and $a->skor > 0) {
                                        $warna = 'danger';
                                    }
                                @endphp
                                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                                    <div class="card-body">
                                        <div class="progress-widget">
                                            <div id="circle-progress-0{{ $a->id }}"
                                                class="text-center circle-progress-0{{ $a->id }} circle-progress circle-progress-{{ $warna }}"
                                                data-min-value="0" data-max-value="100"
                                                data-value="{{ number_format($a->skor, 1, '.', '') }}" data-type="percent">
                                            </div>
                                            <div class="progress-detail">
                                                <p class="mb-2">Aspek {{ $a->urutan }}</p>
                                                <h4 class="counter">{{ number_format($a->skor, 1, '.', '') }}%</h4>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            @php
                                $warna = 'danger';
                                if ($aspek->skor > 75) {
                                    $warna = 'success';
                                } elseif ($aspek->skor < 75 and $aspek->skor > 60) {
                                    $warna = 'warning';
                                } elseif ($aspek->skor < 60 and $aspek->skor > 0) {
                                    $warna = 'danger';
                                }
                            @endphp
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div id="circle-progress-0{{ $aspek->id }}"
                                            class="text-center circle-progress-0{{ $aspek->id }} circle-progress circle-progress-{{ $warna }}"
                                            data-min-value="0" data-max-value="100"
                                            data-value="{{ number_format($aspek->skor, 1, '.', '') }}" data-type="percent">
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Aspek {{ $aspek->urutan }}</p>
                                            <h4 class="counter">{{ number_format($aspek->skor, 1, '.', '') }}%</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        @if (Auth::user()->role == 'User')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h2 class="counter mb-3" style="visibility: visible;">Aspek Anda: <br>
                                    {{ number_format($aspek->skor, 1, '.', '') }}%</h2>
                            </div>
                            <div class="col-8">
                                @foreach ($indikator as $i)
                                    @php
                                        $warna = 'danger';
                                        if ($aspek->skor > 75) {
                                            $warna = 'success';
                                        } elseif ($aspek->skor < 75 and $aspek->skor > 60) {
                                            $warna = 'warning';
                                        } elseif ($aspek->skor < 60 and $aspek->skor > 0) {
                                            $warna = 'danger';
                                        }
                                    @endphp
                                    <div class="pb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <p class="mb-0">Indikator {{ $i->urutan }}</p>
                                            <h4>{{ number_format($i->skor, 1, '.', '') }}%</h4>
                                        </div>
                                        <div class="progress bg-soft-{{ $warna }} shadow-none w-100"
                                            style="height: 10px">
                                            <div class="progress-bar bg-{{ $warna }}" data-toggle="progress-bar"
                                                role="progressbar"
                                                aria-valuenow="{{ number_format($i->skor, 1, '.', '') }}" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 80%; transition: width 2s ease 0s;"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
