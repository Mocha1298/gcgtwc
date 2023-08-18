@extends('layout')
@section('title', 'Data Sub')
@section('sub', 'active')
@section('greeting')
    <h1>Unsur Pemenuhan <span class="tahun">({{ $tahun }})</span></h1>
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
    <style>
        .form-check-input {
            border-color: #00A7E6;

            &:checked {
                border-color: #00A7E6;
                background-color: #00A7E6 !important;
            }

            &:focus {
                border-color: #00A7E6 !important;
                background-color: #fff;
            }
        }
    </style>
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
    <script>
        function cari() {
            var tahun = document.getElementById("tahun").value;
            window.location.href = '/subfaktor/' + tahun;
        }
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/subfaktor/ajax/{{ $tahun }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'urutan'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'parent'
                    },
                    {
                        data: 'isian'
                    },
                    {
                        data: 'evidence'
                    },
                    {
                        data: 'action'
                    },
                ],
            })
        })
    </script>
@endsection

@section('main')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop-1"
                                style="border:none;background: #00A7E6;">
                                <i class="btn-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </i>
                                <span>New</span>
                            </a>
                            <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Sub Baru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/subfaktor/{{ $tahun }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Pilih Aspek</label>
                                                    <div class="form-group">
                                                        <select name="aspek" class="form-select" id=""
                                                            onchange="get_indikator(this.value,{{ $tahun }})"
                                                            required>
                                                            <option value="" selected disabled>Pilih Aspek
                                                            </option>
                                                            @foreach ($aspek as $option)
                                                                <option value="{{ $option->id }}">Aspek
                                                                    {{ $option->urutan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Pilih Indikator</label>
                                                    <div class="form-group">
                                                        <select name="id_parent" class="form-select" id="indikator"
                                                            onchange="get_parameter(this.value,{{ $tahun }})"
                                                            required>
                                                            <option value="" selected disabled>Pilih Indikator
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Pilih Parameter</label>
                                                    <div class="form-group">
                                                        <select name="id_parent" class="form-select" id="parameter"
                                                            onchange="get_faktor(this.value,{{ $tahun }})" required>
                                                            <option selected="" disabled="">Pilih Parameter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Pilih Faktor</label>
                                                    <div class="form-group">
                                                        <select name="id_parent" class="form-select" id="faktor"
                                                            required>
                                                            <option selected="" disabled="">Pilih Faktor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Nama Sub</label>
                                                    <input name="nama" type="text" class="form-control" id="text"
                                                        aria-describedby="text" placeholder="Nama Sub" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="choices-single-default">Sistem
                                                        Penilaian</label>
                                                    <select class="form-select" data-trigger="" name="isian"
                                                        id="choices-single-default">
                                                        <option selected disabled value="">Pilih Salah Satu</option>
                                                        <option value="2">2 Pilihan (0,1)</option>
                                                        <option value="2">3 Pilihan (0,0.5,1)</option>
                                                        <option value="5">5 Pilihan (0,0.25,0.5,0.75,1)</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Eviden</label>
                                                    <div class="form-check d-block">
                                                        <input name="dokumen" class="form-check-input" type="checkbox"
                                                            value="1" id="dokumen">
                                                        <label class="form-check-label" for="dokumen">
                                                            Dokumen
                                                        </label>
                                                    </div>
                                                    <div class="form-check d-block">
                                                        <input name="kuesioner" class="form-check-input" type="checkbox"
                                                            value="1" id="kuesioner">
                                                        <label class="form-check-label" for="kuesioner">
                                                            Kuesioner
                                                        </label>
                                                    </div>
                                                    <div class="form-check d-block">
                                                        <input name="wawancara" class="form-check-input" type="checkbox"
                                                            value="1" id="wawancara">
                                                        <label class="form-check-label" for="wawancara">
                                                            Wawancara
                                                        </label>
                                                    </div>
                                                    <div class="form-check d-block">
                                                        <input name="observasi" class="form-check-input" type="checkbox"
                                                            value="1" id="observasi">
                                                        <label class="form-check-label" for="observasi">
                                                            Observasi
                                                        </label>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="text" class="form-label">Pilih Tahun</label>
                                                    <div class="form-group">
                                                        <select class="form-select" id=""
                                                            name="tahun" required>
                                                            <option @if (date('Y') == 2023) selected @endif
                                                                value="2023">2023</option>
                                                            <option @if (date('Y') == 2024) selected @endif
                                                                value="2024">2024</option>
                                                            <option @if (date('Y') == 2025) selected @endif
                                                                value="2025">2025</option>
                                                            <option @if (date('Y') == 2026) selected @endif
                                                                value="2026">2026</option>
                                                            <option @if (date('Y') == 2027) selected @endif
                                                                value="2027">2027</option>
                                                            <option @if (date('Y') == 2028) selected @endif
                                                                value="2028">2028</option>
                                                            <option @if (date('Y') == 2029) selected @endif
                                                                value="2029">2029</option>
                                                            <option @if (date('Y') == 2030) selected @endif
                                                                value="2030">2030</option>
                                                        </select>
                                                    </div>
                                                </div> --}}
                                                <div class="text-end mt-2">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="border:none;background: #00A7E6;">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2">
                                <button style="border:none;background: #00A7E6;" onclick="cari()"
                                    class="btn btn-success">Go</button>
                            </div>
                            <div class="p-2">
                                <select class="form-select" id="tahun" name="tahun" required="">
                                    <option @if ($tahun == 2023) selected @endif value="2023">2023</option>
                                    <option @if ($tahun == 2024) selected @endif value="2024">2024</option>
                                    <option @if ($tahun == 2025) selected @endif value="2025">2025</option>
                                    <option @if ($tahun == 2026) selected @endif value="2026">2026</option>
                                    <option @if ($tahun == 2027) selected @endif value="2027">2027</option>
                                    <option @if ($tahun == 2028) selected @endif value="2028">2028</option>
                                    <option @if ($tahun == 2029) selected @endif value="2029">2029</option>
                                    <option @if ($tahun == 2030) selected @endif value="2030">2030</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-bs-toggle="data-table">
                                <thead>
                                    <tr class="ligth">
                                        <th>#</th>
                                        <th>Urutan</th>
                                        <th>Nama</th>
                                        <th>Parent</th>
                                        <th>Isian</th>
                                        <th>Evidence</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
