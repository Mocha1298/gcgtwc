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
    <style>
        table.table.table-hover.simple-tree-table td {
            padding: 2px;
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

    <!-- AdminLTE App -->
    <script src="/adminlte.min.js"></script>

    <script src="/jquery-simple-tree-table.js"></script>

    <script>
        $('table').simpleTreeTable({
            opened: []
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
                                <table id="basic" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td style="width: 60%">Uraian</td>
                                            <td style="width: 15%">Bobot</td>
                                            <td style="width: 15%">Tertimbang</td>
                                            <td style="width: 10%">Individu</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @yield('table')
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="table-success">90%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
