@extends('layout')
@section('title', 'Summary')
@section('report', 'active')
@section('link1', '/')
@section('d-aspek', '/aspek')
@section('d-indikator', '/indikator')
@section('d-parameter', '/parameter')
@section('d-faktor', '/faktor')
@section('d-sub', '/sub')
@section('link3', '/user')
@section('link4', '#')
@section('greeting')
    <h1>Summary</h1>
@endsection

@section('css')
    <!-- Favicon -->
    <link rel="shortcut icon" href="../../logo.ico" />

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
    {{-- <style>
        .table-hover tbody tr.expandable-body:hover {
            background-color: inherit !important
        }

        [data-widget=expandable-table] {
            cursor: pointer
        }

        [data-widget=expandable-table] i.expandable-table-caret {
            transition: -webkit-transform .3s linear;
            transition: transform .3s linear;
            transition: transform .3s linear, -webkit-transform .3s linear
        }

        [data-widget=expandable-table][aria-expanded=true] i.expandable-table-caret[class*=right] {
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg)
        }

        [data-widget=expandable-table][aria-expanded=true] i.expandable-table-caret[class*=left] {
            -webkit-transform: rotate(-90deg);
            transform: rotate(-90deg)
        }

        [aria-expanded=true] {
            cursor: pointer
        }

        [aria-expanded=true] i.expandable-table-caret {
            transition: -webkit-transform .3s linear;
            transition: transform .3s linear;
            transition: transform .3s linear, -webkit-transform .3s linear
        }

        [aria-expanded=true] [data-widget=expandable-table] i.expandable-table-caret[class*=right] {
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg)
        }

        [aria-expanded=true] [data-widget=expandable-table] i.expandable-table-caret[class*=left] {
            -webkit-transform: rotate(-90deg);
            transform: rotate(-90deg)
        }

        .expandable-body>td {
            padding: 0 !important;
            width: 100%
        }

        .expandable-body>td>div,
        .expandable-body>td>p {
            padding: .75rem
        }

        .expandable-body .table {
            width: calc(100% - .75rem);
            margin: 0 0 0 .75rem
        }

        .expandable-body .table tr:first-child td,
        .expandable-body .table tr:first-child th {
            border-top: none
        }

        .table>:not(caption)>*>* {
            padding: .5rem 1.5rem;
        }
    </style> --}}
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

    <!-- AdminLTE App -->
    <script src="/adminlte.min.js"></script>

    <script src="/jquery-simple-tree-table.js"></script>

    <script>
        $('#basic').simpleTreeTable({
            expander: $('#expander'),
            collapser: $('#collapser'),
            store: 'session',
            storeKey: 'simple-tree-table-basic'
        });
        $('#open1').on('click', function() {
            $('#basic').data('simple-tree-table').openByID("1");
        });
        $('#close1').on('click', function() {
            $('#basic').data('simple-tree-table').closeByID("1");
        });
    </script>
@endsection


@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Summary List</h4>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <div class="table-responsive">
                                <table id="basic" border="1" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td style="width: 90%">Uraian</td>
                                            <td>Bobot</td>
                                            <td>Tertimbang</td>
                                            <td>Individu</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-node-id="1" class="table-danger">
                                            <td><a href="#">Aspek 1</a></td>
                                            <td>10,000</td>
                                            <td>9,000</td>
                                            <td>90%</td>
                                        </tr>
                                        <tr data-node-id="1.1" data-node-pid="1" class="table-info">
                                            <td><a href="#">Indikator 1</a></td>
                                            <td>10,000</td>
                                            <td>9,000</td>
                                            <td>90%</td>
                                        </tr>
                                        <tr data-node-id="1.1.1" data-node-pid="1.1" class="table-warning">
                                            <td><a href="#">Parameter 1</a></td>
                                            <td>10,000</td>
                                            <td>9,000</td>
                                            <td>90%</td>
                                        </tr>
                                        <tr data-node-id="1.1.1.1" data-node-pid="1.1.1">
                                            <td><a href="#">Faktor 1</a></td>
                                            <td>
                                                <a class="btn btn-sm btn-icon text-info" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop-1">
                                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.634 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path d="M15.9393 12.0129H15.9483" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                        <path d="M11.9301 12.0129H11.9391" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                        <path d="M7.92128 12.0129H7.93028" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Unsur
                                                                    Pemenuhan
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="form-check d-block">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault1">
                                                                            0
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-block">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="flexRadioDefault" id="flexRadioDefault2"
                                                                            checked="">
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault2">
                                                                            1
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="customFile2"
                                                                        class="form-label custom-file-input">Upload
                                                                        Dokumen</label>
                                                                    <input class="form-control" type="file"
                                                                        id="customFile2">
                                                                </div>
                                                                <div class="text-start mt-2">
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-dismiss="modal">Save</button>
                                                                    <button type="button"
                                                                        class="btn btn-danger">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>9,000</td>
                                            <td>90%</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="table-success">90%</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <table class="table table-hover">
    <thead>
        <tr class="text-center">
            <td style="width:90%;">Uraian</td>
            <td>Bobot</td>
            <td>Tertimbang</td>
            <td>Individu</td>
        </tr>
    </thead>
</table>
<table class="table table-hover table-danger">
    <tbody>
        <tr data-widget="expandable-table" aria-expanded="true">
            <td style="width:68%;">
                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                Aspek 1
            </td>
            <td>7.000</td>
            <td>6.898</td>
            <td>98%</td>
        </tr>
        <tr class="expandable-body d-none">
            <td>
                <div class="p-0">
                    <table class="table table-hover table-info">
                        <tbody>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td style="width:68%;">
                                    <i
                                        class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                    indikator 1
                                </td>
                                <td>7.000</td>
                                <td>6.898</td>
                                <td>98%</td>
                            </tr>
                            <tr class="expandable-body d-none">
                                <td>
                                    <div class="p-0">
                                        <table class="table table-hover table-warning">
                                            <tbody>
                                                <tr data-widget="expandable-table"
                                                    aria-expanded="false">
                                                    <td>
                                                        <i
                                                            class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                        Parameter 1
                                                    </td>
                                                </tr>
                                                <tr class="expandable-body d-none">
                                                    <td>
                                                        <div class="p-0"
                                                            style="display: none;">
                                                            <table
                                                                class="table table-hover table-secondary">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width:90%;">
                                                                            Faktor
                                                                            1
                                                                        </td>
                                                                        <td>
                                                                            <a class="btn btn-sm btn-icon text-info"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#staticBackdrop-1">
                                                                                <svg class="icon-32"
                                                                                    width="32"
                                                                                    viewBox="0 0 24 24"
                                                                                    fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        fill-rule="evenodd"
                                                                                        clip-rule="evenodd"
                                                                                        d="M12 2.75C17.108 2.75 21.25 6.891 21.25 12C21.25 17.108 17.108 21.25 12 21.25C6.891 21.25 2.75 17.108 2.75 12C2.75 6.892 6.892 2.75 12 2.75Z"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="1.5"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round">
                                                                                    </path>
                                                                                    <path
                                                                                        d="M15.9393 12.0129H15.9483"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round">
                                                                                    </path>
                                                                                    <path
                                                                                        d="M11.9301 12.0129H11.9391"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round">
                                                                                    </path>
                                                                                    <path
                                                                                        d="M7.92128 12.0129H7.93028"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round">
                                                                                    </path>
                                                                                </svg>
                                                                            </a>
                                                                            <div class="modal fade"
                                                                                id="staticBackdrop-1"
                                                                                data-bs-backdrop="static"
                                                                                data-bs-keyboard="false"
                                                                                tabindex="-1"
                                                                                aria-labelledby="staticBackdropLabel"
                                                                                style="display: none;"
                                                                                aria-hidden="true">
                                                                                <div
                                                                                    class="modal-dialog">
                                                                                    <div
                                                                                        class="modal-content">
                                                                                        <div
                                                                                            class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="staticBackdropLabel">
                                                                                                Unsur
                                                                                                Pemenuhan
                                                                                            </h5>
                                                                                            <button
                                                                                                type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div
                                                                                            class="modal-body">
                                                                                            <div
                                                                                                class="form-group">
                                                                                                <div
                                                                                                    class="form-check d-block">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="flexRadioDefault"
                                                                                                        id="flexRadioDefault1">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="flexRadioDefault1">
                                                                                                        0
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-check d-block">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="flexRadioDefault"
                                                                                                        id="flexRadioDefault2"
                                                                                                        checked="">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="flexRadioDefault2">
                                                                                                        1
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="form-group">
                                                                                                <label
                                                                                                    for="customFile2"
                                                                                                    class="form-label custom-file-input">Upload
                                                                                                    Dokumen</label>
                                                                                                <input
                                                                                                    class="form-control"
                                                                                                    type="file"
                                                                                                    id="customFile2">
                                                                                            </div>
                                                                                            <div
                                                                                                class="text-start mt-2">
                                                                                                <button
                                                                                                    type="button"
                                                                                                    class="btn btn-primary"
                                                                                                    data-bs-dismiss="modal">Save</button>
                                                                                                <button
                                                                                                    type="button"
                                                                                                    class="btn btn-danger">Cancel</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table> --}}
