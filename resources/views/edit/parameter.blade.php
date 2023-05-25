@extends('layout')
@section('title', 'Edit Parameter')
@section('parameter', 'active')
@section('link1', '/')
@section('d-aspek', '/aspek')
@section('d-indikator', '/indikator')
@section('d-parameter', '#')
@section('d-faktor', '/faktor')
@section('d-sub', '/sub')
@section('link3', '/user')
@section('link4', '/report')
@section('greeting')
    <h1>Parameter</h1>
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
                        <h4 class="card-title">Edit Parameter</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/edit/parameter/{{ $master->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="text" class="form-label">Pilih Indikator</label>
                            <div class="form-group">
                                <select name="id_parent" class="form-select" id="exampleFormControlSelect1" onchange="cek()"
                                    required>
                                    <option selected disabled="">Pilih Indikator</option>
                                    @foreach ($indikator as $option)
                                        <option value="{{ $option->id }}"
                                            @if ($master->id_parent == $option->id) selected @endif>Indikator
                                            {{ $option->urutan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Nama Parameter</label>
                            <input name="nama" type="text" class="form-control" id="text" aria-describedby="text"
                                placeholder="Nama Parameter" value="{{ $master->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Bobot</label>
                            <input name="bobot" type="number" class="form-control" id="text" placeholder="Bobot"
                                value="{{ $master->bobot }}" required>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" id="text" cols="30" rows="3">{{ $master->catatan }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Analisis</label>
                            <textarea name="analisis" class="form-control" id="text" cols="30" rows="3">{{ $master->analisis }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Rekomendasi</label>
                            <textarea name="rekomendasi" class="form-control" id="text" cols="30" rows="3">{{ $master->rekomendasi }}</textarea>
                        </div>
                        <div class="text-start mt-2">
                            <button type="submit" class="btn btn-primary"
                                style="border:none;background: #00A7E6;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
