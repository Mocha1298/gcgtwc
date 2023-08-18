@extends('layout')
@section('title', 'Data Parameter')
@section('parameter', 'active')
@section('greeting')
    <h1>Parameter <span class="tahun">({{ $tahun }})</span></h1>
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
    <script>
        function cari() {
            var tahun = document.getElementById("tahun").value;
            window.location.href = '/parameter/' + tahun;
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
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Parameter Baru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/parameter/{{ $tahun }}" method="post">
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
                                                            required>
                                                            <option value="" selected disabled>Pilih Indikator
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Nama Paramater</label>
                                                    <input name="nama" type="text" class="form-control" id="text"
                                                        aria-describedby="text" placeholder="Nama Paramater" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Bobot</label>
                                                    <input name="bobot" type="number" class="form-control" id="text"
                                                        placeholder="Bobot" step="0.001" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Catatan</label>
                                                    <textarea name="catatan" class="form-control" id="text" cols="30" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Analisis</label>
                                                    <textarea name="analisis" class="form-control" id="text" cols="30" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="form-label">Rekomendasi</label>
                                                    <textarea name="rekomendasi" class="form-control" id="text" cols="30" rows="3"></textarea>
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
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr class="ligth">
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Bobot</th>
                                        <th>Parent</th>
                                        {{-- <th>Tahun</th> --}}
                                        <th style="min-width: 100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master as $item)
                                        <tr>
                                            <td>{{ $item->urutan }}</td>
                                            <td id="nama">{{ $item->nama }}</td>
                                            <td>{{ $item->bobot }}</td>
                                            <td>
                                                @foreach ($indikator as $option)
                                                    @if ($item->id_parent == $option->id)
                                                        Indikator {{ $option->urutan }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            {{-- <td>{{ $item->tahun }}</td> --}}
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <a class="btn btn-sm btn-icon text-info" data-bs-placement="top"
                                                        title="Detail" data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $item->id }}">
                                                        <span class="btn-inner">
                                                            <svg class="icon-32" width="32" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.634 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.9393 12.0129H15.9483" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path d="M11.9301 12.0129H11.9391" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path d="M7.92128 12.0129H7.93028" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <!-- Modal Detail -->
                                                    <div class="modal fade" id="detail{{ $item->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" style="display: none;"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                        Paramater {{ $item->urutan }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Analisis</th>
                                                                                <th scope="col">Rekomendasi</th>
                                                                                <th scope="col">Catatan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{ $item->analisis }}</td>
                                                                                <td>{{ $item->rekomendasi }}</td>
                                                                                <td>{{ $item->catatan }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <a class="btn btn-sm btn-icon text-info" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Parameter" href="/parameter">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.7161 16.2234H8.49609" stroke="currentColor"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path d="M15.7161 12.0369H8.49609" stroke="currentColor"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path d="M11.2521 7.86011H8.49707" stroke="currentColor"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a> --}}
                                                    <a class="btn btn-sm btn-icon text-primary" data-bs-toggle="tooltip"
                                                        href="/edit/parameter/{{ $item->id }}" aria-label="Edit"
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
                                                        href="#" aria-label="Delete"
                                                        data-bs-original-title="Delete"
                                                        onclick="hapus('parameter',{{ $item->id }})">
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
