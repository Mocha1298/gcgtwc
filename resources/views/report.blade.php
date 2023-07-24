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

        td#nama {
            cursor: pointer;
        }

        form#detail_child {
            color: black;
        }

        form#detail_child input {
            color: black;
        }

        .simple-tree-table-handler.simple-tree-table-icon {
            margin-right: 10px;
        }

        a.btn-kotak {
            width: 25px;
            padding: 0;
            margin-right: 3px;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        a.btn-kotak:focus {
            background-color: #0080b0;
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

        function cari() {
            var tahun = document.getElementById("tahun").value;
            window.location.href = '/report/' + tahun;
        }

        function showdet(id, type) {
            if (document.getElementById('detail_child')) {
                document.getElementById('detail_child').remove();
            }
            $.ajax({
                type: 'GET',
                url: "/getdet/" + id + "/" + type,
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Sedang Memuat Detail</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(e) {
                    Swal.close()
                    console.log(id);
                    var token = '{{ csrf_token() }}'
                    if (e.detail.catatan == null) {
                        e.detail.catatan = "";
                    }
                    if (e.detail.rekomendasi == null) {
                        e.detail.rekomendasi = "";
                    }
                    if (e.detail.analisis == null) {
                        e.detail.analisis = "";
                    }
                    if (e.type == 'Aspek' || e.type == 'Faktor') {
                        var div = document.getElementById("detail_information")
                        div.innerHTML += "<form action='/summary/" + e.type + "/" + id +
                            "' method='post' id='detail_child'><label class='mb-3'>Title : " + e.detail.nama +
                            "</label>\n<input type='hidden' name='_token' value='" + token +
                            "'><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Catatan:</label><div class='col-sm-9'><textarea name='catatan' rows='2' class='form-control' id='catatan' maxlength='2000'>" +
                            e.detail.catatan +
                            "</textarea><small>Maksimal 2000 karakter</small></div></div><button type='submit' style='border:none;background: #00A7E6;' class='btn btn-success mt-3'>Submit</button></form>";
                    } else {
                        var div = document.getElementById("detail_information")
                        div.innerHTML += "<form action='/summary/" + e.type + "/" + id +
                            "' method='post' id='detail_child'><label class='mb-3'>Title : " + e.detail.nama +
                            "</label>\n<input type='hidden' name='_token' value='" + token +
                            "'><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Catatan:</label><div class='col-sm-9'><textarea name='catatan' rows='2' class='form-control' id='catatan' maxlength='2000'>" +
                            e.detail.catatan +
                            "</textarea><small>Maksimal 2000 karakter</small></div></div><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Analisis:</label><div class='col-sm-9'><textarea name='analisis' rows='2' class='form-control' id='analisis' maxlength='2000'>" +
                            e.detail.analisis +
                            "</textarea></div></div><div class='form-group row'><label class='control-label col-sm-3 align-self-center mb-0' for=''>Rekomendasi:</label><div class='col-sm-9'><textarea name='rekomendasi' rows='2' class='form-control' id='rekomendasi' maxlength='2000'>" +
                            e.detail.rekomendasi +
                            "</textarea><small>Maksimal 2000 karakter</small></div></div><button type='submit' style='border:none;background: #00A7E6;' class='btn btn-success mt-3'>Submit</button></form>";
                    }
                }
            });
        }

        function show_fuk(id) {
            $.ajax({
                type: 'GET',
                url: "/getfuk/" + id,
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Sedang Memuat Form</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(evidence) {
                    form = $(".modal-body#" + id);
                    form.empty();
                    $.each(evidence, function(index, evidence) {
                        console.log(evidence);
                        buttonfordokumen = "";
                        buttonforkuesioner = "";
                        buttonforwawancara = "";
                        buttonforobservasi = "";
                        formfordokumen = "";
                        formforkuesioner = "";
                        formforwawancara = "";
                        formforobservasi = "";
                        isianforall = "";
                        isian = "";
                        isian =
                            "<div class='form-group row'>" +
                            "<label class='control-label col-sm-3 mb-0' for=''>FUK:</label>" +
                            "<div class='col-sm-9'>" +
                            "<label class='control-label col-sm mb-0' for=''>" + evidence.nama +
                            "</label>" +
                            "</div>" +
                            "</div>" +
                            "<label class='control-label col-sm-3 align-self-center' for='dokumen'>Evidence:</label>";
                        display = "";
                        if (evidence.dokumen == 1) {
                            // button
                            warna = "#00A7E6";
                            if (evidence.dokumen_file == "") {
                                warna = "#bbbec1";
                            }
                            buttonfordokumen = document.createElement("a");
                            buttonfordokumen.innerText = "D";
                            const att = document.createAttribute("class");
                            att.value = "btn btn-kotak dokumen" + evidence.id;
                            buttonfordokumen.setAttributeNode(att);
                            const att2 = document.createAttribute("style");
                            att2.value = "border:none;background: " + warna +
                                ";color:white;font-weight:bolder;width: 25px;padding: 0;margin-right: 3px;";
                            buttonfordokumen.setAttributeNode(att2);
                            const att3 = document.createAttribute("onclick");
                            att3.value = "input('dokumen'," + evidence.id + ")";
                            buttonfordokumen.setAttributeNode(att3);
                            const att4 = document.createAttribute("data-bs-toggle");
                            att4.value = "tooltip";
                            buttonfordokumen.setAttributeNode(att4);
                            const att5 = document.createAttribute("data-bs-placement");
                            att5.value = "top";
                            buttonfordokumen.setAttributeNode(att5);
                            const att6 = document.createAttribute("title");
                            att6.value = "Dokumen";
                            buttonfordokumen.setAttributeNode(att6);
                            // button
                            // form
                            formfordokumen += "<div class='form-group row' style='" + display +
                                "' id='dokumen" + evidence.id +
                                "'><label class='control-label col-sm-3 mb-0' for=''>Dokumen:</label><div class='col-sm-9 mt-3 mb-3' id='evidence'>";
                            if (evidence.dokumen_file == null) {
                                formfordokumen +=
                                    "<a href='#'><span style='border:none;background: #dc3545;' class='badge badge-pill badge-primary'>File belum diupload</span></a>";
                            } else {
                                formfordokumen +=
                                    "<a href='#'><span style='border:none;background: #28a745;' class='badge badge-pill badge-primary'>File sudah diupload</span></a><a href='/files/" +
                                    evidence.dokumen_file +
                                    "'><span style='border:none;background: #00A7E6;' class='badge badge-pill badge-primary'>Unduh File</span></a>";
                            }
                            formfordokumen += "</div></div>";
                            // form
                            display = "display:none";
                        }
                        if (evidence.kuesioner == 1) {
                            // button
                            warna = "#00A7E6";
                            if (evidence.kuesioner_file == "") {
                                warna = "#bbbec1";
                            }
                            buttonforkuesioner = document.createElement("a");
                            buttonforkuesioner.innerText = "K";
                            const att = document.createAttribute("class");
                            att.value = "btn btn-kotak kuesioner" + evidence.id;
                            buttonforkuesioner.setAttributeNode(att);
                            const att2 = document.createAttribute("style");
                            att2.value = "border:none;background: " + warna +
                                ";color:white;font-weight:bolder;width: 25px;padding: 0;margin-right: 3px;";
                            buttonforkuesioner.setAttributeNode(att2);
                            const att3 = document.createAttribute("onclick");
                            att3.value = "input('kuesioner'," + evidence.id + ")";
                            buttonforkuesioner.setAttributeNode(att3);
                            const att4 = document.createAttribute("data-bs-toggle");
                            att4.value = "tooltip";
                            buttonforkuesioner.setAttributeNode(att4);
                            const att5 = document.createAttribute("data-bs-placement");
                            att5.value = "top";
                            buttonforkuesioner.setAttributeNode(att5);
                            const att6 = document.createAttribute("title");
                            att6.value = "Kuesioner";
                            buttonforkuesioner.setAttributeNode(att6);
                            // button
                            // form
                            formforkuesioner += "<div class='form-group row' style='" + display +
                                "' id='kuesioner" + evidence.id +
                                "'><label class='control-label col-sm-3 mb-0' for=''>Kuesioner:</label><div class='col-sm-9 mt-3 mb-3' id='evidence'>";
                            if (evidence.kuesioner_file == null) {
                                formforkuesioner +=
                                    "<a href='#'><span style='border:none;background: #dc3545;' class='badge badge-pill badge-primary'>File belum diupload</span></a>"
                            } else {
                                formforkuesioner +=
                                    "<a href='#'><span style='border:none;background: #28a745;' class='badge badge-pill badge-primary'>File sudah diupload</span></a><a href='/files/" +
                                    evidence.kuesioner_file +
                                    "'><span style='border:none;background: #00A7E6;' class='badge badge-pill badge-primary'>Unduh File</span></a>"
                            }
                            formforkuesioner += "</div></div>";
                            // form
                            display = "display:none";
                        }
                        if (evidence.wawancara == 1) {
                            // button
                            warna = "#00A7E6";
                            if (evidence.wawancara_file == "") {
                                warna = "#bbbec1";
                            }
                            buttonforwawancara = document.createElement("a");
                            buttonforwawancara.innerText = "W";
                            const att = document.createAttribute("class");
                            att.value = "btn btn-kotak wawancara" + evidence.id;
                            buttonforwawancara.setAttributeNode(att);
                            const att2 = document.createAttribute("style");
                            att2.value = "border:none;background: " + warna +
                                ";color:white;font-weight:bolder;width: 25px;padding: 0;margin-right: 3px;";
                            buttonforwawancara.setAttributeNode(att2);
                            const att3 = document.createAttribute("onclick");
                            att3.value = "input('wawancara'," + evidence.id + ")";
                            buttonforwawancara.setAttributeNode(att3);
                            const att4 = document.createAttribute("data-bs-toggle");
                            att4.value = "tooltip";
                            buttonforwawancara.setAttributeNode(att4);
                            const att5 = document.createAttribute("data-bs-placement");
                            att5.value = "top";
                            buttonforwawancara.setAttributeNode(att5);
                            const att6 = document.createAttribute("title");
                            att6.value = "Wawancara";
                            buttonforwawancara.setAttributeNode(att6);
                            // button
                            // form
                            formforwawancara += "<div class='form-group row' style='" + display +
                                "' id='wawancara" + evidence.id +
                                "'><label class='control-label col-sm-3 mb-0' for=''>Wawancara:</label><div class='col-sm-9 mt-3 mb-3' id='evidence'>";
                            if (evidence.wawancara_file == null) {
                                formforwawancara +=
                                    "<a href='#'><span style='border:none;background: #dc3545;' class='badge badge-pill badge-primary'>File belum diupload</span></a>"
                            } else {
                                formforwawancara +=
                                    "<a href='#'><span style='border:none;background: #28a745;' class='badge badge-pill badge-primary'>File sudah diupload</span></a><a href='/files/" +
                                    evidence.wawancara_file +
                                    "'><span style='border:none;background: #00A7E6;' class='badge badge-pill badge-primary'>Unduh File</span></a>"
                            }
                            formforwawancara += "</div></div>";
                            // form
                            display = "display:none";
                        }
                        if (evidence.observasi == 1) {
                            // button
                            warna = "#00A7E6";
                            if (evidence.observasi_file == "") {
                                warna = "#bbbec1";
                            }
                            buttonforobservasi = document.createElement("a");
                            buttonforobservasi.innerText = "O";
                            const att = document.createAttribute("class");
                            att.value = "btn btn-kotak observasi" + evidence.id;
                            buttonforobservasi.setAttributeNode(att);
                            const att2 = document.createAttribute("style");
                            att2.value = "border:none;background: " + warna +
                                ";color:white;font-weight:bolder;width: 25px;padding: 0;margin-right: 3px;";
                            buttonforobservasi.setAttributeNode(att2);
                            const att3 = document.createAttribute("onclick");
                            att3.value = "input('observasi'," + evidence.id + ")";
                            buttonforobservasi.setAttributeNode(att3);
                            const att4 = document.createAttribute("data-bs-toggle");
                            att4.value = "tooltip";
                            buttonforobservasi.setAttributeNode(att4);
                            const att5 = document.createAttribute("data-bs-placement");
                            att5.value = "top";
                            buttonforobservasi.setAttributeNode(att5);
                            const att6 = document.createAttribute("title");
                            att6.value = "Observasi";
                            buttonforobservasi.setAttributeNode(att6);
                            // button
                            // form
                            formforobservasi += "<div class='form-group row' style='" + display +
                                "' id='observasi" + evidence.id +
                                "'><label class='control-label col-sm-3 mb-0' for=''>Observasi:</label><div class='col-sm-9 mt-3 mb-3' id='evidence'>";
                            if (evidence.observasi_file == null) {
                                formforobservasi +=
                                    "<a href='#'><span style='border:none;background: #dc3545;' class='badge badge-pill badge-primary'>File belum diupload</span></a>"
                            } else {
                                formforobservasi +=
                                    "<a href='#'><span style='border:none;background: #28a745;' class='badge badge-pill badge-primary'>File sudah diupload</span></a><a href='/files/" +
                                    evidence.observasi_file +
                                    "'><span style='border:none;background: #00A7E6;' class='badge badge-pill badge-primary'>Unduh File</span></a>"
                            }
                            formforobservasi += "</div></div>";
                            // form
                            display = "display:none";
                        }
                        if (evidence.isian == 2) {
                            cheked1 = "";
                            cheked0 = "";
                            if (evidence.skor == 1) {
                                cheked1 = "checked";
                            } else {
                                cheked0 = "checked";
                            }
                            isianforall +=
                                "<div class='form-group row mb-4'><label class='radio-inline col-sm-3'>Skor</label><label class='radio-inline col-sm-1'><input value='0' type='radio' id='" +
                                evidence.id + "' name='skor" + evidence.id + "' " + cheked0 +
                                ">0</label><label class='radio-inline col-sm-1'><input value='1' type='radio'id='" +
                                evidence.id + "' name='skor" + evidence.id + "'" + cheked1 +
                                ">1</label></div>";
                        } else if (evidence.isian == 3) {
                            cheked1 = "";
                            cheked05 = "";
                            cheked0 = "";
                            if (evidence.skor == 1) {
                                cheked1 = "checked";
                            } else if (evidence.skor == 0.5) {
                                cheked05 = "checked";
                            } else {
                                cheked0 = "checked";
                            }
                            isianforall +=
                                "<div class='form-group row mb-4'><label class='radio-inline col-sm-3'>Skor</label><label class='radio-inline col-sm-1'><input value='0' type='radio' id='" +
                                evidence.id + "' name='skor" + evidence.id + "' " + cheked0 +
                                ">0</label><label class='radio-inline col-sm-1'><input value='0.5' type='radio' id='" +
                                evidence.id + "' name='skor" + evidence.id + "' " + cheked05 +
                                ">0.5</label><label class='radio-inline col-sm-1'><input value='1' type='radio' id='" +
                                evidence.id + "' name='skor" + evidence.id + "'" + cheked1 +
                                ">1</label></div>"
                        } else if (evidence.isian == 5) {
                            cheked1 = "";
                            cheked025 = "";
                            cheked05 = "";
                            cheked075 = "";
                            cheked0 = "";
                            if (evidence.skor == 1) {
                                cheked1 = "checked";
                            } else if (evidence.skor == 0.75) {
                                cheked075 = "checked";
                            } else if (evidence.skor == 0.5) {
                                cheked05 = "checked";
                            } else if (evidence.skor == 0.25) {
                                cheked25 = "checked";
                            } else {
                                cheked0 = "checked";
                            }
                            isianforall +=
                                "<div class='form-group row mb-4'><label class='radio-inline col-sm-3'>Skor</label><label class='radio-inline col-sm'><input value='0' type='radio' id='" +
                                evidence.id + "' name='skor" + evidence.id + "' " + cheked0 +
                                ">0</label><label class='radio-inline col-sm'><input value='0.25' type='radio'id='" +
                                evidence.id + "' name='skor" + evidence.id + "'" + cheked025 +
                                ">0.25</label><label class='radio-inline col-sm'><input value='0.5' type='radio'id='" +
                                evidence.id + "' name='skor" + evidence.id + "'" + cheked05 +
                                ">0.5</label><label class='radio-inline col-sm'><input value='0.75' type='radio'id='" +
                                evidence.id + "' name='skor" + evidence.id + "'" + cheked075 +
                                ">0.75</label><label class='radio-inline col-sm'><input value='1' type='radio'id='" +
                                evidence.id + "' name='skor" + evidence.id + "'" + cheked1 +
                                ">1</label></div>";
                        }
                        br = document.createElement("br");
                        hr = document.createElement("hr");
                        form.append(
                            isian,
                            buttonfordokumen,
                            buttonforkuesioner,
                            buttonforwawancara,
                            buttonforobservasi,
                            br,
                            formfordokumen,
                            formforkuesioner,
                            formforwawancara,
                            formforwawancara,
                            isianforall,
                            hr
                        );
                    })
                    Swal.close()
                }
            });
            console.log($("input#" + id));
            $("#form" + id).modal("show");
        }

        function submit(id) {
            $.ajax({
                type: 'GET',
                url: "/getfuk/" + id,
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Sedang Menyimpan Data</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(sub) {
                    $.each(sub, function(index, sub) {
                        const values = document.querySelectorAll('input[name="skor' + sub.id + '"]')
                        let skor;
                        for (const value of values) {
                            if (value.checked) {
                                skor = value.value;
                                break;
                            }
                        }
                        $.ajax({
                            url: "/summary/" + sub.id,
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "nilai": skor
                            },
                            success: function(response) {
                                console.log(response);
                            },
                        });
                    });
                    Swal.close()
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil disimpan',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                }
            })
        }

        function cek(form, id) {
            const fileInput = $("#" + form + id);
            console.log(fileInput[0].value);

            // var input = document.getElementById(id);
            var file = fileInput[0].files;
            console.log(file);
            if (file.length > 0) {
                var fileSize = Math.round((file[0].size / 1024));
                if (fileSize >= 10 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ukuran maksimal 10MB!',
                        confirmButtonColor: '#0093ad !important',
                    })
                    document.getElementById(form + id).style.borderColor = "red";
                    fileInput[0].value = "";
                } else {
                    var filePath = fileInput[0].value;
                    // Allowing file type
                    var allowedExtensions =
                        /(\.jpg|\.jpeg|\.png|\.pdf|\.xls|\.xlsx|\.doc|\.docx)$/i;
                    if (!allowedExtensions.exec(filePath)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'File yang didukung *jpg,*jpeg,*png,*pdf,*xls,*xlsx,*doc,*docx',
                            confirmButtonColor: '#0093ad !important',
                        })
                        document.getElementById(form + id).style.borderColor = "red";
                        fileInput[0].value = "";
                        return false;
                    } else {
                        document.getElementById(form + id).style.borderColor = "#ccc";
                    }
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'File belum dipilih!',
                    confirmButtonColor: '#0093ad !important',
                })
                document.getElementById(form + id).style.borderColor = "red";
            }
        }

        function input(content, id) {
            if (content == 'dokumen') {
                $(".dokumen" + id).css({
                    'filter': 'brightness(85%)'
                })
                $("#dokumen" + id).show();
                $(".kuesioner" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".wawancara" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".observasi" + id).css({
                    'filter': 'brightness(100%)'
                });
                $("#kuesioner" + id).hide();
                $("#wawancara" + id).hide();
                $("#observasi" + id).hide();
            }
            if (content == 'kuesioner') {
                $(".kuesioner" + id).css({
                    'filter': 'brightness(85%)'
                })
                $("#kuesioner" + id).show();
                $(".dokumen" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".wawancara" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".observasi" + id).css({
                    'filter': 'brightness(100%)'
                });
                $("#dokumen" + id).hide();
                $("#wawancara" + id).hide();
                $("#observasi" + id).hide();
            }
            if (content == 'wawancara') {
                $(".wawancara" + id).css({
                    'filter': 'brightness(85%)'
                })
                $("#wawancara" + id).show();
                $(".kuesioner" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".dokumen" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".observasi" + id).css({
                    'filter': 'brightness(100%)'
                });
                $("#kuesioner" + id).hide();
                $("#dokumen" + id).hide();
                $("#observasi" + id).hide();
            }
            if (content == 'observasi') {
                $(".observasi" + id).css({
                    'filter': 'brightness(85%)'
                })
                $("#observasi" + id).show();
                $(".kuesioner" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".wawancara" + id).css({
                    'filter': 'brightness(100%)'
                });
                $(".dokumen" + id).css({
                    'filter': 'brightness(100%)'
                });
                $("#kuesioner" + id).hide();
                $("#wawancara" + id).hide();
                $("#dokumen" + id).hide();
            }
        }

        function loading() {
            swal.fire({
                html: '<h5>Sedang Memuat Detail</h5>',
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
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
                                <button onclick="show_fuk(179)">ok</button>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                    <button style='border:none;background: #00A7E6;' onclick="cari()"
                                        class="btn btn-success">Go</button>
                                </div>
                                <div class="p-2">
                                    <select class="form-select" id="tahun" name="tahun" required>
                                        <option @if (date('Y') == 2023 || $tahun == 2023) selected @endif value="2023">2023
                                        </option>
                                        <option @if (date('Y') == 2024 || $tahun == 2024) selected @endif value="2024">2024
                                        </option>
                                        <option @if (date('Y') == 2025 || $tahun == 2025) selected @endif value="2025">2025
                                        </option>
                                        <option @if (date('Y') == 2026 || $tahun == 2026) selected @endif value="2026">2026
                                        </option>
                                        <option @if (date('Y') == 2027 || $tahun == 2027) selected @endif value="2027">2027
                                        </option>
                                        <option @if (date('Y') == 2028 || $tahun == 2028) selected @endif value="2028">2028
                                        </option>
                                        <option @if (date('Y') == 2029 || $tahun == 2029) selected @endif value="2029">2029
                                        </option>
                                        <option @if (date('Y') == 2030 || $tahun == 2030) selected @endif value="2030">2030
                                        </option>
                                    </select>
                                </div>
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
                                        @php
                                            $warna = 'danger';
                                            if ($total >= 80) {
                                                $warna = 'success';
                                            } elseif ($total < 80 and $total >= 60) {
                                                $warna = 'warning';
                                            } elseif ($total < 60 and $total >= 0) {
                                                $warna = 'danger';
                                            }
                                        @endphp
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="bg-{{ $warna }} text-center text-light">
                                                {{ number_format($total, 1, '.', '') }}%
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
