@extends('layout')
@section('title', 'Edit Sub')
@section('sub', 'active')
@section('link1', '/')
@section('d-aspek', '/aspek')
@section('d-indikator', '/indikator')
@section('d-parameter', '/parameter')
@section('d-faktor', '/faktor')
@section('d-sub', '#')
@section('link3', '/user')
@section('link4', '/report')
@section('greeting')
    <h1>Unsur Pemenuhan</h1>
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
                    <form action="/edit/subfaktor/{{ $master->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="text" class="form-label">Pilih Parameter</label>
                            <div class="form-group">
                                <select name="id_parent" class="form-select" id="exampleFormControlSelect1" onchange="cek()"
                                    required>
                                    <option selected disabled="">Pilih Parameter</option>
                                    @foreach ($faktor as $option)
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
                            <label class="form-label" for="choices-single-default">Sistem
                                Penilaian</label>
                            <select class="form-select" data-trigger="" name="isian" id="choices-single-default">
                                <option disabled value="">Pilih Salah Satu</option>
                                <option @if ($master->isian == 2) selected @endif value="2">2 Pilihan (0,1)
                                </option>
                                <option @if ($master->isian == 5) selected @endif value="5">5 Pilihan
                                    (0,0.25,0.5,0.75,1)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Eviden</label>
                            <div class="form-check d-block">
                                <input name="dokumen" class="form-check-input" type="checkbox" value="1" id="dokumen"
                                    @if ($master->dokumen == true) checked @endif>
                                <label class="form-check-label" for="dokumen">
                                    Dokumen
                                </label>
                            </div>
                            <div class="form-check d-block">
                                <input name="kuesioner" class="form-check-input" type="checkbox" value="1"
                                    id="kuesioner" @if ($master->kuesioner == true) checked @endif>
                                <label class="form-check-label" for="kuesioner">
                                    Kuesioner
                                </label>
                            </div>
                            <div class="form-check d-block">
                                <input name="wawancara" class="form-check-input" type="checkbox" value="1"
                                    id="wawancara" @if ($master->wawancara == true) checked @endif>
                                <label class="form-check-label" for="wawancara">
                                    Wawancara
                                </label>
                            </div>
                            <div class="form-check d-block">
                                <input name="observasi" class="form-check-input" type="checkbox" value="1"
                                    id="observasi" @if ($master->observasi == true) checked @endif>
                                <label class="form-check-label" for="observasi">
                                    Observasi
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text" class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" id="text" cols="30" rows="3">{{ $master->catatan }}</textarea>
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
