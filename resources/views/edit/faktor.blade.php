@extends('layout')
@section('title', 'Edit Faktor')
@section('faktor', 'active')
@section('link1', '/')
@section('d-aspek', '/aspek')
@section('d-indikator', '/indikator')
@section('d-parameter', '/parameter')
@section('d-faktor', '/faktor')
@section('d-sub', '/sub')
@section('link3', '/user')
@section('link4', '/report')
@section('greeting')
    <h1>Faktor</h1>
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
                        <h4 class="card-title">Edit Faktor</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/edit/faktor/{{ $master->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="text" class="form-label">Pilih Parameter</label>
                            <div class="form-group">
                                <select name="id_parent" class="form-select" id="exampleFormControlSelect1" onchange="cek()"
                                    required>
                                    <option selected disabled="">Pilih Parameter</option>
                                    @foreach ($parameter as $option)
                                        <option value="{{ $option->id }}"
                                            @if ($master->id_parent == $option->id) selected @endif>Parameter
                                            {{ $option->urutan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Nama Faktor</label>
                            <input name="nama" type="text" class="form-control" id="text" aria-describedby="text"
                                placeholder="Nama Faktor" value="{{ $master->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Keterangan</label>
                            <input name="keterangan" type="text" class="form-control" id="text"
                                aria-describedby="text" placeholder="Keterangan" value="{{ $master->keterangan }}">
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" id="text" cols="30" rows="3">{{ $master->catatan }}</textarea>
                        </div>
                        <div class="text-end mt-2">
                            <button type="submit" class="btn btn-primary"
                                style="border:none;background: #00A7E6;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
