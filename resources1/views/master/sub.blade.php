@extends('layout')
@section('title', 'Data Sub')
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
    <h1>Unsur Pemenuhan <span class="tahun">({{$tahun}})</span></h1>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </i>
                                <span>New</span>
                            </a>
                            <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Sub Baru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/subfaktor/{{$tahun}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Pilih Faktor</label>
                                                    <div class="form-group">
                                                        <select name="id_parent" class="form-select"
                                                            id="exampleFormControlSelect1" onchange="cek()">
                                                            <option selected="" disabled="">Pilih Faktor</option>
                                                            @foreach ($faktor as $item)
                                                                <option value="{{ $item->id }}">Faktor {{ $item->urutan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Nama Sub</label>
                                                    <input name="nama" type="text" class="form-control" id="text"
                                                        aria-describedby="text" placeholder="Nama Sub">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="choices-single-default">Sistem
                                                        Penilaian</label>
                                                    <select class="form-select" data-trigger="" name="isian"
                                                        id="choices-single-default">
                                                        <option disabled value="">Pilih Salah Satu</option>
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
                                                            <option @if (date("Y") == 2023) selected @endif
                                                                value="2023">2023</option>
                                                            <option @if (date("Y") == 2024) selected @endif
                                                                value="2024">2024</option>
                                                            <option @if (date("Y") == 2025) selected @endif
                                                                value="2025">2025</option>
                                                            <option @if (date("Y") == 2026) selected @endif
                                                                value="2026">2026</option>
                                                            <option @if (date("Y") == 2027) selected @endif
                                                                value="2027">2027</option>
                                                            <option @if (date("Y") == 2028) selected @endif
                                                                value="2028">2028</option>
                                                            <option @if (date("Y") == 2029) selected @endif
                                                                value="2029">2029</option>
                                                            <option @if (date("Y") == 2030) selected @endif
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
                                <button style="border:none;background: #00A7E6;" onclick="cari()" class="btn btn-success">Go</button>
                            </div>
                            <div class="p-2">
                                <select class="form-select" id="tahun" name="tahun" required="">
                                    <option @if ($tahun == 2023) selected @endif
                                    value="2023">2023</option>
                                <option @if ($tahun == 2024) selected @endif
                                    value="2024">2024</option>
                                <option @if ($tahun == 2025) selected @endif
                                    value="2025">2025</option>
                                <option @if ($tahun == 2026) selected @endif
                                    value="2026">2026</option>
                                <option @if ($tahun == 2027) selected @endif
                                    value="2027">2027</option>
                                <option @if ($tahun == 2028) selected @endif
                                    value="2028">2028</option>
                                <option @if ($tahun == 2029) selected @endif
                                    value="2029">2029</option>
                                <option @if ($tahun == 2030) selected @endif
                                    value="2030">2030</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table id="user-list-table" class="table" role="grid" data-bs-toggle="data-table">
                                <thead>
                                    <tr class="ligth">
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Parent</th>
                                        <th>Eviden</th>
                                        <th>Penilaian</th>
                                        <th>Tahun</th>
                                        <th style="min-width: 100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master as $item)
                                        <tr>
                                            <td>{{ $item->urutan }}</td>
                                            <td id="nama">{{ $item->nama }}</td>
                                            <td>
                                                @foreach ($faktor as $option)
                                                    @if ($item->id_parent == $option->id)
                                                        Faktor {{ $option->urutan }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($item->dokumen == true)
                                                    <a style="border:none;background: #00A7E6;color:white"
                                                        class="btn btn-sm btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Dokumen" href="#">
                                                        D
                                                    </a>
                                                @endif
                                                @if ($item->kuesioner == true)
                                                    <a style="border:none;background: #00A7E6;color:white"
                                                        class="btn btn-sm btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Kuesioner" href="#">
                                                        K
                                                    </a>
                                                @endif
                                                @if ($item->wawancara == true)
                                                    <a style="border:none;background: #00A7E6;color:white"
                                                        class="btn btn-sm btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Wawancara" href="#">
                                                        W
                                                    </a>
                                                @endif
                                                @if ($item->observasi == true)
                                                    <a style="border:none;background: #00A7E6;color:white"
                                                        class="btn btn-sm btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Observasi" href="#">
                                                        O
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $item->isian }} Pilihan</td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <a class="btn btn-sm btn-icon text-primary" data-bs-toggle="tooltip"
                                                        href="/edit/subfaktor/{{ $item->id }}" aria-label="Edit"
                                                        data-bs-original-title="Edit">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon text-danger " data-bs-toggle="tooltip"
                                                        aria-label="Delete" data-bs-original-title="Delete"
                                                        onclick="hapus('subfaktor',{{ $item->id }})">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                stroke="currentColor">
                                                                <path
                                                                    d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path
                                                                    d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection