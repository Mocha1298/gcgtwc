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
    <link rel="stylesheet" href="../../assets/css/core/libs.min.css" />
    <link rel="stylesheet" href="../../assets/css/hope-ui.min.css?v=2.0.0" />
    <link rel="stylesheet" href="../../assets/css/custom.min.css?v=2.0.0" />
    <link rel="stylesheet" href="../../assets/css/dark.min.css" />
    <link rel="stylesheet" href="../../assets/css/customizer.min.css" />
    <link rel="stylesheet" href="../../assets/css/rtl.min.css" />
    <style>
        table.table.table-hover.simple-tree-table td {
            padding: 2px;
            border-radius: 6px;
            max-width: 10%;
            margin-bottom: .4em;
        }

        span.simple-tree-table-handler.simple-tree-table-icon {
            border-radius: 6px;
        }

        table.table.table-hover.simple-tree-table td a {
            color: black;
        }

        table {
            border-collapse: inherit;
            font-size: 12px;
            color: white;
        }

        hr {
            margin: 1rem 0;
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 0.25;
        }

        .form-group {
            margin-bottom: 3px;
        }
        td#nama{
            cursor: pointer;
        }
        form#detail_child{
            color: black;
        }
        form#detail_child input{
            color: black;
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
        function showdet(id,type) {
            if (document.getElementById('detail_child')) {
                document.getElementById('detail_child').remove();
            }
            $.ajax({
                type: 'GET',
                url: "/getdet/"+id+"/"+type,
                success: function(e) {
                    console.log(id);
                    var token = '{{csrf_token()}}'
                    if(e.detail.catatan == null){
                        e.detail.catatan = "";
                    }
                    if(e.detail.rekomendasi == null){
                        e.detail.rekomendasi = "";
                    }
                    if(e.detail.analisis == null){
                        e.detail.analisis = "";
                    }
                    if (e.type == 'Aspek' || e.type == 'Faktor') {
                        var div = document.getElementById("detail_information")
                        div.innerHTML += "<form action='/summary/"+e.type+"/"+id+"' method='post' id='detail_child'><label class='mb-3'>Title : "+e.detail.nama+"</label>\n<input type='hidden' name='_token' value='"+token+"'><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Catatan:</label><div class='col-sm-9'><input value='"+e.detail.catatan+"' name='catatan' type='text' class='form-control' id='catatan' placeholder='Catatan'></div></div><button type='submit' style='border:none;background: #00A7E6;' class='btn btn-success mt-3'>Submit</button></form>";
                    } else {
                        var div = document.getElementById("detail_information")
                        div.innerHTML += "<form action='/summary/"+e.type+"/"+id+"' method='post' id='detail_child'><label class='mb-3'>Title : "+e.detail.nama+"</label>\n<input type='hidden' name='_token' value='"+token+"'><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Catatan:</label><div class='col-sm-9'><input value='"+e.detail.catatan+"' name='catatan' type='text' class='form-control' id='catatan' placeholder='Catatan'></div></div><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Analisis:</label><div class='col-sm-9'><input value='"+e.detail.analisis+"' name='analisis' type='text' class='form-control' id='analisis' placeholder='Analisis'></div></div><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Rekomendasi:</label><div class='col-sm-9'><input value='"+e.detail.rekomendasi+"' name='rekomendasi' type='text' class='form-control' id='rekomendasi' placeholder='Rekomendasi'></div></div><button type='submit' style='border:none;background: #00A7E6;' class='btn btn-success mt-3'>Submit</button></form>";
                    }
                }
            });
        }
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="color: white;font-weight: 700;background: rgb(58, 79, 122)">
                                        <td class="text-center">Uraian</td>
                                        <td class="text-center">Bobot</td>
                                        <td class="text-center">Tertimbang</td>
                                        <td class="text-center">Individu</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @yield('table')
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="table-success text-center">{{ number_format($total, 1, '.', '') }}%
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Summary Detail</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="detail_information" class="container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
