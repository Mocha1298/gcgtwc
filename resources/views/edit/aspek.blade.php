@extends('layout')
@section('title', 'Edit Aspek')
@section('aspek', 'active')
@section('link1', '/')
@section('d-aspek', '#')
@section('d-indikator', '/indikator')
@section('d-parameter', '/parameter')
@section('d-faktor', '/faktor')
@section('d-sub', '/sub')
@section('link3', '/user')
@section('link4', '/report')
@section('greeting')
    <h1>Aspek</h1>
@endsection

@section('css')
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="../../assets/css/core/libs.min.css" />


    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="../../assets/css/hope-ui.min.css?v=2.0.0" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="../../assets/css/custom.min.css?v=2.0.0" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="../../assets/css/dark.min.css" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="../../assets/css/customizer.min.css" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="../../assets/css/rtl.min.css" />
@endsection

@section('script')
    <!-- Library Bundle Script -->
    <script src="../../assets/js/core/libs.min.js"></script>

    <!-- External Library Bundle Script -->
    <script src="../../assets/js/core/external.min.js"></script>

    <!-- Widgetchart Script -->
    <script src="../../assets/js/charts/widgetcharts.js"></script>

    <!-- mapchart Script -->
    <script src="../../assets/js/charts/vectore-chart.js"></script>
    <script src="../../assets/js/charts/dashboard.js"></script>

    <!-- fslightbox Script -->
    <script src="../../assets/js/plugins/fslightbox.js"></script>

    <!-- Settings Script -->
    <script src="../../assets/js/plugins/setting.js"></script>

    <!-- Slider-tab Script -->
    <script src="../../assets/js/plugins/slider-tabs.js"></script>

    <!-- Form Wizard Script -->
    <script src="../../assets/js/plugins/form-wizard.js"></script>

    <!-- AOS Animation Plugin-->

    <!-- App Script -->
    <script src="../../assets/js/hope-ui.js" defer></script>
@endsection

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Aspek</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/edit/aspek/{{ $master->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="text" class="form-label">Nama Aspek</label>
                            <input type="text" class="form-control" id="text" aria-describedby="text"
                                placeholder="Nama Aspek" name="nama" value="{{ $master->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Bobot</label>
                            <input type="text" class="form-control" id="text" aria-describedby="text"
                                placeholder="Bobot" name="bobot" value="{{ $master->bobot }}">
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" id="text" cols="30" rows="3">{{ $master->catatan }}</textarea>
                        </div>
                        <div class="text-end mt-2">
                            <button style="border:none;background: #00A7E6;" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
