{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


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
    <a href="/report" class="mt-4 btn btn-danger d-block rounded">Go to Summary</a>
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
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-01"
                                        class="text-center circle-progress-01 circle-progress circle-progress-warning"
                                        data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Aspek 1</p>
                                        <h4 class="counter">60%</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-02"
                                        class="text-center circle-progress-01 circle-progress circle-progress-success"
                                        data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Aspek 2</p>
                                        <h4 class="counter">80%</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-03"
                                        class="text-center circle-progress-01 circle-progress circle-progress-danger"
                                        data-min-value="0" data-max-value="100" data-value="20" data-type="percent">
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Aspek 3</p>
                                        <h4 class="counter">20%</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-04"
                                        class="text-center circle-progress-01 circle-progress circle-progress-info"
                                        data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24px" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Revenue</p>
                                        <h4 class="counter">$742K</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-05"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="100" data-value="50" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24px" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Net Income</p>
                                        <h4 class="counter">$150K</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-06"
                                        class="text-center circle-progress-01 circle-progress circle-progress-info"
                                        data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Today</p>
                                        <h4 class="counter">$4600</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-07"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                        <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Members</p>
                                        <h4 class="counter">11.2M</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h2 class="counter mb-3" style="visibility: visible;">Total: 62.2%</h2>
                            <p class="mb-2">Aspek Anda</p>
                            <h6>25%</h6>
                        </div>
                        <div class="col-8">
                            <div class="pb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0">Aspek 1</p>
                                    <h4>60%</h4>
                                </div>
                                <div class="progress bg-soft-warning shadow-none w-100" style="height: 10px">
                                    <div class="progress-bar bg-warning" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 60%; transition: width 2s ease 0s;"></div>
                                </div>
                            </div>
                            <div class="pb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0">Aspek 2</p>
                                    <h4>80%</h4>
                                </div>
                                <div class="progress bg-soft-success shadow-none w-100" style="height: 10px">
                                    <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 80%; transition: width 2s ease 0s;"></div>
                                </div>
                            </div>
                            <div class="pb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0">Aspek 3</p>
                                    <h4>20%</h4>
                                </div>
                                <div class="progress bg-soft-danger shadow-none w-100" style="height: 10px">
                                    <div class="progress-bar bg-danger" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 80%; transition: width 2s ease 0s;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
