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
    <h1>Selamat Datang</h1>
@endsection

@section('css')
    <!-- Favicon -->
    <link rel="shortcut icon" href="/logo.ico" />

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
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            {{-- DANGER --}}
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">Aspek 1</div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div>
                                <h2 class="counter">0.25</h2>
                                25%
                            </div>
                            <div class="border  bg-soft-danger rounded p-3">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.24512 14.7815L10.2383 10.8914L13.6524 13.5733L16.5815 9.79297"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <circle cx="19.9954" cy="4.20027" r="1.9222" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path
                                        d="M14.9248 3.12012H7.65704C4.6456 3.12012 2.77832 5.25284 2.77832 8.26428V16.3467C2.77832 19.3581 4.60898 21.4817 7.65704 21.4817H16.2612C19.2726 21.4817 21.1399 19.3581 21.1399 16.3467V9.30776"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                                <div class="progress-bar bg-danger" data-toggle="progress-bar" role="progressbar"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- INFO --}}
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">Aspek 2</div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div>
                                <h2 class="counter">0.5</h2>
                                50%
                            </div>
                            <div class="border bg-soft-info rounded p-3">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.24512 14.7815L10.2383 10.8914L13.6524 13.5733L16.5815 9.79297"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <circle cx="19.9954" cy="4.20027" r="1.9222" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path
                                        d="M14.9248 3.12012H7.65704C4.6456 3.12012 2.77832 5.25284 2.77832 8.26428V16.3467C2.77832 19.3581 4.60898 21.4817 7.65704 21.4817H16.2612C19.2726 21.4817 21.1399 19.3581 21.1399 16.3467V9.30776"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                                <div class="progress-bar bg-info" data-toggle="progress-bar" role="progressbar"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Primary --}}
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">Aspek 3</div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div>
                                <h2 class="counter">.75</h2>
                                75%
                            </div>
                            <div class="border  bg-soft-primary rounded p-3">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.24512 14.7815L10.2383 10.8914L13.6524 13.5733L16.5815 9.79297"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <circle cx="19.9954" cy="4.20027" r="1.9222" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path
                                        d="M14.9248 3.12012H7.65704C4.6456 3.12012 2.77832 5.25284 2.77832 8.26428V16.3467C2.77832 19.3581 4.60898 21.4817 7.65704 21.4817H16.2612C19.2726 21.4817 21.1399 19.3581 21.1399 16.3467V9.30776"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="progress bg-soft-primary shadow-none w-100" style="height: 6px">
                                <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- SUCCESS --}}
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">Aspek 4</div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div>
                                <h2 class="counter">1</h2>
                                100%
                            </div>
                            <div class="border bg-soft-success rounded p-3">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.24512 14.7815L10.2383 10.8914L13.6524 13.5733L16.5815 9.79297"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <circle cx="19.9954" cy="4.20027" r="1.9222" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path
                                        d="M14.9248 3.12012H7.65704C4.6456 3.12012 2.77832 5.25284 2.77832 8.26428V16.3467C2.77832 19.3581 4.60898 21.4817 7.65704 21.4817H16.2612C19.2726 21.4817 21.1399 19.3581 21.1399 16.3467V9.30776"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="progress bg-soft-success shadow-none w-100" style="height: 6px">
                                <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="counter mb-3" style="visibility: visible;">Total: 62.2%</h2>
                        <p class="mb-2">Aspek Anda</p>
                        <h6>25%</h6>
                        <a href="/report" class="mt-4 btn btn-danger d-block rounded">Go to Summary</a>
                        <div class="mt-3">
                            <div class="pb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0">Indikator 1</p>
                                    <h4>25%</h4>
                                </div>
                                <div class="progress bg-soft-info shadow-none w-100" style="height: 10px">
                                    <div class="progress-bar bg-info" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 60%; transition: width 2s ease 0s;"></div>
                                </div>
                            </div>
                            <div class="pb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0">Indikator 2</p>
                                    <h4>25%</h4>
                                </div>
                                <div class="progress bg-soft-success shadow-none w-100" style="height: 10px">
                                    <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
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
