@extends('report')

@php
    use App\Models\Master;
    $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI'];
@endphp

@section('table')
    @foreach ($aspek as $a)
        @php
            $warna = 'danger';
            if ($a->skor >= 80) {
                $warna = 'success';
            } elseif ($a->skor < 80 and $a->skor >= 60) {
                $warna = 'warning';
            } elseif ($a->skor < 60 and $a->skor >= 0) {
                $warna = 'danger';
            }
        @endphp
        <tr data-node-id="{{ $a->id }}" id="aspek" style="color: white;background: rgba(58, 79, 122, 0.200)">
            <td id="nama" >
                <a 
                @if (Auth::user()->role == "Admin")
                    onclick="showdet({{$a->id}},'Aspek')"
                @else
                    @if (Auth::user()->id_master == $a->id)
                    onclick="showdet({{$a->id}},'Aspek')"
                    @endif
                @endif
                >{{ $romawi[$a->urutan - 1] }}. {{ $a->nama }}</a>
            </td>
            <td class="text-center">{{ $a->bobot }}</td>
            <td class="text-center">{{ number_format($a->tertimbang, 3, '.', '') }}</td>
            <td class="text-center bg-{{ $warna }} text-light">{{ number_format($a->skor, 1, '.', '') }}%</td>
        </tr>
        @if (Auth::user()->role == "Admin")
            @php
                $indikator = DB::table('masters')->where('id_parent',$a->id)->get();
            @endphp
            @foreach ($indikator as $i)
                @if ($a->id == $i->id_parent)
                    @php
                        $index = $i->id;
                    @endphp
                    @php
                        $warna = 'danger';
                        $arsir = 'jos';
                        $negatif = 0;
                        if ($i->skor >= 80) {
                            $warna = 'success';
                        } elseif ($i->skor < 80 and $i->skor >= 60) {
                            $warna = 'warning';
                        } elseif ($i->skor < 60 and $i->skor >= 0) {
                            $warna = 'danger';
                        }if($i->keterangan == 'Negatif'){
                            $negatif = 1;
                            $warna = 'black';
                            $arsir = 'background-image:linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red  76%, red),linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red 76%, red);background-size:5px 5px, 5px 5px, 100% 100%;background-position:0px 0px, 3px 3px, 0px 0px;';
                        }
                    @endphp
                    <tr data-node-id="{{ $a->id }}.{{ $i->id }}" id="indikator" data-node-pid="{{ $a->id }}"
                        style="color: white;background: rgba(58, 79, 122, 0.100)">
                        <td id="nama" ><a onclick="showdet({{$i->id}},'Indikator')">{{ $i->urutan }}. {{ $i->nama }}</a></td>
                        <td class="text-center">{{ $i->bobot }}</td>
                        <td class="text-center">{{ number_format($i->tertimbang, 3, '.', '') }}</td>
                        <td class="text-center bg-{{ $warna }} text-light" style="{{$arsir}}">{{ number_format($i->skor, 1, '.', '') }}%</td>
                    </tr>
                    @php
                        $parameter = [];
                        $count_par = 0;
                        for ($i=0; $i < count($indikator); $i++) { 
                            $data = DB::table('masters')->where('id_parent',$indikator[$i]->id)->get()->toArray();
                            $count_par = count($data);
                            for ($i1=0; $i1 < $count_par; $i1++) {
                                array_push($parameter,$data[$i1]);
                            }
                        }
                    @endphp
                    @for ($p = 0;$p < count($parameter);$p++)
                        @php
                            $warna = 'danger';
                            if ($parameter[$p]->skor >= 80) {
                                $warna = 'success';
                            } elseif ($parameter[$p]->skor < 80 and $parameter[$p]->skor >= 60) {
                                $warna = 'warning';
                            } elseif ($parameter[$p]->skor < 60 and $parameter[$p]->skor >= 0) {
                                $warna = 'danger';
                            }if($negatif == 1){
                                $warna = 'black';
                                $arsir = 'background-image:linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red  76%, red),linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red 76%, red);background-size:5px 5px, 5px 5px, 100% 100%;background-position:0px 0px, 3px 3px, 0px 0px;';
                            }
                        @endphp
                        @if ($index == $parameter[$p]->id_parent)
                            <tr data-node-id="{{ $a->id }}.{{ $index }}.{{ $parameter[$p]->id }}" id="parameter"
                                data-node-pid="{{ $a->id }}.{{ $index }}"
                                style="color: white;background: rgba(58, 79, 122, 0.050)">
                                <td id="nama" ><a onclick="showdet({{$parameter[$p]->id}},'Parameter')">{{ $parameter[$p]->urutan }}. {{ $parameter[$p]->nama }}</a>
                                </td>
                                <td class="text-center">{{ $parameter[$p]->bobot }}</td>
                                <td class="text-center">{{ number_format($parameter[$p]->tertimbang, 3, '.', '') }}</td>
                                <td class="text-center bg-{{ $warna }} text-light" style="{{$arsir}}">{{ number_format($parameter[$p]->skor, 1, '.', '') }}%</td>
                            </tr>
                            @php
                                $faktor = [];
                                $count_fak = 0;
                                for ($f=0; $f < count($parameter); $f++) { 
                                    $data = DB::table('masters')->where('id_parent',$parameter[$f]->id)->get()->toArray();
                                    $count_fak = count($data);
                                    for ($f1=0; $f1 < $count_fak; $f1++) {
                                        array_push($faktor,$data[$f1]);
                                    }
                                }
                            @endphp
                            @for ($f=0;$f<count($faktor);$f++)
                                @php
                                    $warna = 'danger';
                                    $arsir = 'jos';
                                    if ($faktor[$f]->skor >= 80) {
                                        $warna = 'success';
                                    } elseif ($faktor[$f]->skor < 80 and $faktor[$f]->skor >= 60) {
                                        $warna = 'warning';
                                    } elseif ($faktor[$f]->skor < 60 and $faktor[$f]->skor >= 0) {
                                        $warna = 'danger';
                                    }if($negatif == 1){
                                        $warna = 'black';
                                        $arsir = 'background-image:linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red  76%, red),linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red 76%, red);background-size:5px 5px, 5px 5px, 100% 100%;background-position:0px 0px, 3px 3px, 0px 0px;';
                                    }
                                @endphp
                                @if ($parameter[$p]->id == $faktor[$f]->id_parent)
                                    <tr data-node-id="{{ $a->id }}.{{ $index }}.{{ $parameter[$p]->id }}.{{ $faktor[$f]->id }}" id="faktor"
                                        data-node-pid="{{ $a->id }}.{{ $index }}.{{ $parameter[$p]->id }}"
                                        style="color: white;">
                                        <td id="nama" ><a onclick="showdet({{$faktor[$f]->id}},'Faktor')">
                                                {{ $faktor[$f]->urutan }}. {{ $faktor[$f]->nama }}</a></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-icon text-info" data-bs-toggle="modal"
                                                data-bs-target="#form{{ $faktor[$f]->id }}">
                                                <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.634 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                    <path d="M15.9393 12.0129H15.9483" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path d="M11.9301 12.0129H11.9391" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path d="M7.92128 12.0129H7.93028" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                        <div class="modal fade" id="form{{ $faktor[$f]->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            Unsur
                                                            Pemenuhan
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/summary/{{ $faktor[$f]->id }}" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @php
                                                                $sub = [];
                                                                $count_sub = 0;
                                                                for ($s=0; $s < count($faktor); $s++) { 
                                                                    $data = DB::table('masters')->where('id_parent',$faktor[$s]->id)->get()->toArray();
                                                                    $count_sub = count($data);
                                                                    for ($s1=0; $s1 < $count_sub; $s1++) {
                                                                        array_push($sub,$data[$s1]);
                                                                    }
                                                                }
                                                            @endphp
                                                            @foreach ($sub as $s)
                                                                @if ($faktor[$f]->id == $s->id_parent)
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-sm-3 mb-0"
                                                                            for="">FUK:</label>
                                                                        <div class="col-sm-9">
                                                                            <label class="control-label col-sm mb-0"
                                                                                for=""> {{ $s->nama }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <label
                                                                        class="control-label col-sm-3 align-self-center"
                                                                        for="dokumen">Evidence:</label>
                                                                    @if ($s->dokumen == 1)
                                                                        @php
                                                                            $warna1 = '#00A7E6';
                                                                            if ($s->dokumen_file == "") {
                                                                                $warna1 = '#bbbec1';
                                                                            }
                                                                        @endphp
                                                                        <a onclick="input('dokumen',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                            class="btn btn-kotak dokumen{{ $s->id }}" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" title="Dokumen" href="#">
                                                                            D
                                                                        </a>
                                                                    @endif
                                                                    @if ($s->kuesioner == 1)
                                                                        @php
                                                                            $warna1 = '#00A7E6';
                                                                            if ($s->kuesioner_file == "") {
                                                                                $warna1 = '#bbbec1';
                                                                            }
                                                                        @endphp
                                                                        <a onclick="input('kuesioner',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                            class="btn btn-kotak kuesioner{{ $s->id }}" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" title="Kuesioner" href="#">
                                                                            K
                                                                        </a>
                                                                    @endif
                                                                    @if ($s->wawancara == 1)
                                                                        @php
                                                                            $warna1 = '#00A7E6';
                                                                            if ($s->wawancara_file == "") {
                                                                                $warna1 = '#bbbec1';
                                                                            }
                                                                        @endphp
                                                                        <a onclick="input('wawancara',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                            class="btn btn-kotak wawancara{{ $s->id }}" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" title="Wawancara" href="#">
                                                                            W
                                                                        </a>
                                                                
                                                                    @endif
                                                                    @if ($s->observasi == 1)
                                                                        @php
                                                                            $warna1 = '#00A7E6';
                                                                            if ($s->observasi_file == "") {
                                                                                $warna1 = '#bbbec1';
                                                                            }
                                                                        @endphp
                                                                        <a onclick="input('observasi',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                            class="btn btn-kotak observasi{{ $s->id }}" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" title="Observasi" href="#">
                                                                            O
                                                                        </a>
                                                                    @endif
                                                                    @php
                                                                        $display = "";
                                                                    @endphp
                                                                    @if ($s->dokumen == 1)
                                                                        <div class="form-group row" style="{{$display}}" id="dokumen{{ $s->id }}">
                                                                            <label class="control-label col-sm-3 mb-0"
                                                                            for="">Dokumen:</label>
                                                                            <div class="col-sm-9 mt-3 mb-3">
                                                                                <input class="form-control" type="file" id="file" name="dokumen{{ $s->id }}">
                                                                                @if ($s->dokumen_file == "")
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                            File belum diupload
                                                                                        </span>
                                                                                    </a>
                                                                                @else
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                            File sudah diupload
                                                                                        </span>
                                                                                    </a>
                                                                                    <a href="/files/{{$s->dokumen_file}}">
                                                                                        <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                            Unduh File
                                                                                        </span>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $display = "display:none";
                                                                        @endphp
                                                                    @endif
                                                                    @if ($s->kuesioner == 1)
                                                                        <div class="form-group row" style="{{$display}}" id="kuesioner{{ $s->id }}">
                                                                            <label class="control-label col-sm-3 mb-0"
                                                                                for="">Kuesioner:</label>
                                                                            <div class="col-sm-9 mt-3 mb-3">
                                                                                <input class="form-control" type="file" id="file" name="kuesioner{{ $s->id }}">
                                                                                @if ($s->kuesioner_file == "")
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                            File belum diupload
                                                                                        </span>
                                                                                    </a>
                                                                                @else
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                            File sudah diupload
                                                                                        </span>
                                                                                    </a>
                                                                                    <a href="/files/{{$s->kuesioner_file}}">
                                                                                        <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                            Unduh FIle
                                                                                        </span>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $display = "display:none";
                                                                        @endphp
                                                                    @endif
                                                                    @if ($s->wawancara == 1)
                                                                        <div class="form-group row" style="{{$display}}" id="wawancara{{ $s->id }}">
                                                                            <label class="control-label col-sm-3 mb-0"
                                                                                for="">Wawancara:</label>
                                                                            <div class="col-sm-9 mt-3 mb-3">
                                                                                <input class="form-control" type="file" id="file" name="wawancara{{ $s->id }}">
                                                                                @if ($s->wawancara_file == "")
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                            File belum diupload
                                                                                        </span>
                                                                                    </a>
                                                                                @else
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                            File sudah diupload
                                                                                        </span>
                                                                                    </a>
                                                                                    <a href="/files/{{$s->wawancara_file}}">
                                                                                        <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                            Unduh File
                                                                                        </span>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $display = "display:none";
                                                                        @endphp
                                                                    @endif
                                                                    @if ($s->observasi == 1)
                                                                        <div class="form-group row" style="{{$display}}" id="observasi{{ $s->id }}">
                                                                            <label class="control-label col-sm-3 mb-0"
                                                                                for="">Observasi:</label>
                                                                            <div class="col-sm-9 mt-3 mb-3">
                                                                                <input class="form-control" type="file" id="file" name="observasi{{ $s->id }}">
                                                                                @if ($s->observasi_file == "")
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                            File belum diupload
                                                                                        </span>
                                                                                    </a>
                                                                                @else
                                                                                    <a href="#">
                                                                                        <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                            File sudah diupload
                                                                                        </span>
                                                                                    </a>
                                                                                    <a href="/files/{{$s->observasi_file}}">
                                                                                        <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                            Unduh File
                                                                                        </span>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $display = "display:none";
                                                                        @endphp
                                                                    @endif
                                                                    @if ($s->isian == 2)
                                                                        <div class="form-group row mb-4">
                                                                            <label class="radio-inline col-sm-3">
                                                                                Skor
                                                                            </label>
                                                                            <label class="radio-inline col-sm-1">
                                                                                <input value="0" type="radio"
                                                                                    name="skor[{{ $s->id }}]"
                                                                                    @if ($s->skor == 0) checked @endif>
                                                                                0
                                                                            </label>
                                                                            <label class="radio-inline col-sm-1">
                                                                                <input value="1" type="radio"
                                                                                    name="skor[{{ $s->id }}]"
                                                                                    @if ($s->skor == 1) checked @endif>
                                                                                1
                                                                            </label>
                                                                        </div>
                                                                    @elseif($s->isian == 5)
                                                                        <div class="form-group row mb-4">
                                                                            <label class="radio-inline col-sm-3">
                                                                                Skor
                                                                            </label>
                                                                            <label class="radio-inline col-sm">
                                                                                <input value="0" type="radio"
                                                                                    name="skor[{{ $s->id }}]"
                                                                                    @if ($s->skor == 0) checked @endif>
                                                                                0
                                                                            </label>
                                                                            <label class="radio-inline col-sm">
                                                                                <input value="0.25" type="radio"
                                                                                    name="skor[{{ $s->id }}]"
                                                                                    @if ($s->skor == 0.25) checked @endif>
                                                                                0.25
                                                                            </label>
                                                                            <label class="radio-inline col-sm">
                                                                                <input value="0.5" type="radio"
                                                                                    name="skor[{{ $s->id }}]"
                                                                                    @if ($s->skor == 0.5) checked @endif>
                                                                                0.5
                                                                            </label>
                                                                            <label class="radio-inline col-sm">
                                                                                <input value="0.75" type="radio"
                                                                                    name="skor[{{ $s->id }}]"
                                                                                    @if ($s->skor == 0.75) checked @endif>
                                                                                0.75
                                                                            </label>
                                                                            <label class="radio-inline col-sm">
                                                                                <input value="1" type="radio"
                                                                                    name="skor[{{ $s->id }}]"
                                                                                    @if ($s->skor == 1) checked @endif>
                                                                                1
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                    <hr>
                                                                @endif
                                                                <hr>
                                                            @endforeach
                                                            <div class="text-end mt-2">
                                                                <button style="border:none;background: #00A7E6;"
                                                                    type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <td class="text-center">
                                            @for ($i = 1; $i <= 4; $i++)
                                                @if ($i <= $faktor[$f]->tertimbang)
                                                    <svg style="color: gold;" class="icon-15" width="15"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.9184 14.32C17.6594 14.571 17.5404 14.934 17.5994 15.29L18.4884 20.21C18.5634 20.627 18.3874 21.049 18.0384 21.29C17.6964 21.54 17.2414 21.57 16.8684 21.37L12.4394 19.06C12.2854 18.978 12.1144 18.934 11.9394 18.929H11.6684C11.5744 18.943 11.4824 18.973 11.3984 19.019L6.96839 21.34C6.74939 21.45 6.50139 21.489 6.25839 21.45C5.66639 21.338 5.27139 20.774 5.36839 20.179L6.25839 15.259C6.31739 14.9 6.19839 14.535 5.93939 14.28L2.32839 10.78C2.02639 10.487 1.92139 10.047 2.05939 9.65C2.19339 9.254 2.53539 8.965 2.94839 8.9L7.91839 8.179C8.29639 8.14 8.62839 7.91 8.79839 7.57L10.9884 3.08C11.0404 2.98 11.1074 2.888 11.1884 2.81L11.2784 2.74C11.3254 2.688 11.3794 2.645 11.4394 2.61L11.5484 2.57L11.7184 2.5H12.1394C12.5154 2.539 12.8464 2.764 13.0194 3.1L15.2384 7.57C15.3984 7.897 15.7094 8.124 16.0684 8.179L21.0384 8.9C21.4584 8.96 21.8094 9.25 21.9484 9.65C22.0794 10.051 21.9664 10.491 21.6584 10.78L17.9184 14.32Z"
                                                            fill="currentColor">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg style="color: grey" class="icon-15" width="15"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </td>
                                        <td class="text-center bg-{{ $warna }} text-light" style="{{$arsir}}">
                                            {{ number_format($faktor[$f]->skor, 1, '.', '') }}%</td>
                                    </tr>
                                @endif
                            @endfor
                        @endif
                    @endfor
                @endif
            @endforeach
        @else
            {{-- @if (Auth::user()->id_master == $a->id)
                @foreach ($indikator as $i)
                    @if ($a->id == $i->id_parent)
                        @php
                            $index = $i->id;
                        @endphp
                        @php
                            $warna = 'danger';
                            $arsir = 'jos';
                            $negatif = 0;
                            if ($i->skor >= 80) {
                                $warna = 'success';
                            } elseif ($i->skor < 80 and $i->skor >= 60) {
                                $warna = 'warning';
                            } elseif ($i->skor < 60 and $i->skor >= 0) {
                                $warna = 'danger';
                            }if($i->keterangan == 'Negatif'){
                                $negatif = 1;
                                $warna = 'black';
                                $arsir = 'background-image:linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red  76%, red),linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red 76%, red);background-size:5px 5px, 5px 5px, 100% 100%;background-position:0px 0px, 3px 3px, 0px 0px;';
                            }
                        @endphp
                        <tr data-node-id="{{ $a->id }}.{{ $i->id }}" id="indikator" data-node-pid="{{ $a->id }}"
                            style="color: white;background: rgba(58, 79, 122, 0.100)">
                            <td id="nama" ><a onclick="showdet({{$i->id}},'Indikator')">{{ $i->urutan }}. {{ $i->nama }}</a></td>
                            <td class="text-center">{{ $i->bobot }}</td>
                            <td class="text-center">{{ number_format($i->tertimbang, 3, '.', '') }}</td>
                            <td class="text-center bg-{{ $warna }} text-light" style="{{$arsir}}">{{ number_format($i->skor, 1, '.', '') }}%</td>
                        </tr>
                        @foreach ($parameter as $p)
                            @php
                                $warna = 'danger';
                                if ($p->skor >= 80) {
                                    $warna = 'success';
                                } elseif ($p->skor < 80 and $p->skor >= 60) {
                                    $warna = 'warning';
                                } elseif ($p->skor < 60 and $p->skor >= 0) {
                                    $warna = 'danger';
                                }if($negatif == 1){
                                    $warna = 'black';
                                    $arsir = 'background-image:linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red  76%, red),linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red 76%, red);background-size:5px 5px, 5px 5px, 100% 100%;background-position:0px 0px, 3px 3px, 0px 0px;';
                                }
                            @endphp
                            @if ($index == $p->id_parent)
                                <tr data-node-id="{{ $a->id }}.{{ $index }}.{{ $p->id }}" id="parameter"
                                    data-node-pid="{{ $a->id }}.{{ $index }}"
                                    style="color: white;background: rgba(58, 79, 122, 0.050)">
                                    <td id="nama" ><a onclick="showdet({{$p->id}},'Parameter')">{{ $p->urutan }}. {{ $p->nama }}</a>
                                    </td>
                                    <td class="text-center">{{ $p->bobot }}</td>
                                    <td class="text-center">{{ number_format($p->tertimbang, 3, '.', '') }}</td>
                                    <td class="text-center bg-{{ $warna }} text-light" style="{{$arsir}}">{{ number_format($p->skor, 1, '.', '') }}%</td>
                                </tr>
                                @foreach ($faktor as $f)
                                    @php
                                        $warna = 'danger';
                                        $arsir = 'jos';
                                        if ($f->skor >= 80) {
                                            $warna = 'success';
                                        } elseif ($f->skor < 80 and $f->skor >= 60) {
                                            $warna = 'warning';
                                        } elseif ($f->skor < 60 and $f->skor >= 0) {
                                            $warna = 'danger';
                                        }if($negatif == 1){
                                            $warna = 'black';
                                            $arsir = 'background-image:linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red  76%, red),linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red 76%, red);background-size:5px 5px, 5px 5px, 100% 100%;background-position:0px 0px, 3px 3px, 0px 0px;';
                                        }
                                    @endphp
                                    @if ($p->id == $f->id_parent)
                                        <tr data-node-id="{{ $a->id }}.{{ $index }}.{{ $p->id }}.{{ $f->id }}" id="faktor"
                                            data-node-pid="{{ $a->id }}.{{ $index }}.{{ $p->id }}"
                                            style="color: white;">
                                            <td id="nama" ><a onclick="showdet({{$f->id}},'Faktor')">
                                                    {{ $f->urutan }}. {{ $f->nama }}</a></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-icon text-info" data-bs-toggle="modal"
                                                    data-bs-target="#form{{ $f->id }}">
                                                    <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.634 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                        <path d="M15.9393 12.0129H15.9483" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                        <path d="M11.9301 12.0129H11.9391" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                        <path d="M7.92128 12.0129H7.93028" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </td>
                                            <div class="modal fade" id="form{{ $f->id }}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Unsur
                                                                Pemenuhan
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="/summary/{{ $f->id }}" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf
                                                                @foreach ($sub as $s)
                                                                    @if ($f->id == $s->id_parent)
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-3 mb-0"
                                                                                for="">FUK:</label>
                                                                            <div class="col-sm-9">
                                                                                <label class="control-label col-sm mb-0"
                                                                                    for=""> {{ $s->nama }}</label>
                                                                            </div>
                                                                        </div>
                                                                        <label
                                                                            class="control-label col-sm-3 align-self-center"
                                                                            for="dokumen">Evidence:</label>
                                                                        @if ($s->dokumen == 1)
                                                                            @php
                                                                                $warna1 = '#00A7E6';
                                                                                if ($s->dokumen_file == "") {
                                                                                    $warna1 = '#bbbec1';
                                                                                }
                                                                            @endphp
                                                                            <a onclick="input('dokumen',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                                class="btn btn-kotak dokumen{{ $s->id }}" data-bs-toggle="tooltip"
                                                                                data-bs-placement="top" title="Dokumen" href="#">
                                                                                D
                                                                            </a>
                                                                        @endif
                                                                        @if ($s->kuesioner == 1)
                                                                            @php
                                                                                $warna1 = '#00A7E6';
                                                                                if ($s->kuesioner_file == "") {
                                                                                    $warna1 = '#bbbec1';
                                                                                }
                                                                            @endphp
                                                                            <a onclick="input('kuesioner',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                                class="btn btn-kotak kuesioner{{ $s->id }}" data-bs-toggle="tooltip"
                                                                                data-bs-placement="top" title="Kuesioner" href="#">
                                                                                K
                                                                            </a>
                                                                        @endif
                                                                        @if ($s->wawancara == 1)
                                                                            @php
                                                                                $warna1 = '#00A7E6';
                                                                                if ($s->wawancara_file == "") {
                                                                                    $warna1 = '#bbbec1';
                                                                                }
                                                                            @endphp
                                                                            <a onclick="input('wawancara',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                                class="btn btn-kotak wawancara{{ $s->id }}" data-bs-toggle="tooltip"
                                                                                data-bs-placement="top" title="Wawancara" href="#">
                                                                                W
                                                                            </a>
                                                                    
                                                                        @endif
                                                                        @if ($s->observasi == 1)
                                                                            @php
                                                                                $warna1 = '#00A7E6';
                                                                                if ($s->observasi_file == "") {
                                                                                    $warna1 = '#bbbec1';
                                                                                }
                                                                            @endphp
                                                                            <a onclick="input('observasi',{{ $s->id }})" style="border:none;background: {{$warna1}};color:white;font-weight:bolder;"
                                                                                class="btn btn-kotak observasi{{ $s->id }}" data-bs-toggle="tooltip"
                                                                                data-bs-placement="top" title="Observasi" href="#">
                                                                                O
                                                                            </a>
                                                                        @endif
                                                                        @php
                                                                            $display = "";
                                                                        @endphp
                                                                        @if ($s->dokumen == 1)
                                                                            <div class="form-group row" style="{{$display}}" id="dokumen{{ $s->id }}">
                                                                                <label class="control-label col-sm-3 mb-0"
                                                                                for="">Dokumen:</label>
                                                                                <div class="col-sm-9 mt-3 mb-3">
                                                                                    <input class="form-control" type="file" id="file" name="dokumen{{ $s->id }}">
                                                                                    @if ($s->dokumen_file == "")
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                                File belum diupload
                                                                                            </span>
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                                File sudah diupload
                                                                                            </span>
                                                                                        </a>
                                                                                        <a href="/files/{{$s->dokumen_file}}">
                                                                                            <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                                Unduh File
                                                                                            </span>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $display = "display:none";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($s->kuesioner == 1)
                                                                            <div class="form-group row" style="{{$display}}" id="kuesioner{{ $s->id }}">
                                                                                <label class="control-label col-sm-3 mb-0"
                                                                                    for="">Kuesioner:</label>
                                                                                <div class="col-sm-9 mt-3 mb-3">
                                                                                    <input class="form-control" type="file" id="file" name="kuesioner{{ $s->id }}">
                                                                                    @if ($s->kuesioner_file == "")
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                                File belum diupload
                                                                                            </span>
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                                File sudah diupload
                                                                                            </span>
                                                                                        </a>
                                                                                        <a href="/files/{{$s->kuesioner_file}}">
                                                                                            <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                                Unduh FIle
                                                                                            </span>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $display = "display:none";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($s->wawancara == 1)
                                                                            <div class="form-group row" style="{{$display}}" id="wawancara{{ $s->id }}">
                                                                                <label class="control-label col-sm-3 mb-0"
                                                                                    for="">Wawancara:</label>
                                                                                <div class="col-sm-9 mt-3 mb-3">
                                                                                    <input class="form-control" type="file" id="file" name="wawancara{{ $s->id }}">
                                                                                    @if ($s->wawancara_file == "")
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                                File belum diupload
                                                                                            </span>
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                                File sudah diupload
                                                                                            </span>
                                                                                        </a>
                                                                                        <a href="/files/{{$s->wawancara_file}}">
                                                                                            <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                                Unduh File
                                                                                            </span>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $display = "display:none";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($s->observasi == 1)
                                                                            <div class="form-group row" style="{{$display}}" id="observasi{{ $s->id }}">
                                                                                <label class="control-label col-sm-3 mb-0"
                                                                                    for="">Observasi:</label>
                                                                                <div class="col-sm-9 mt-3 mb-3">
                                                                                    <input class="form-control" type="file" id="file" name="observasi{{ $s->id }}">
                                                                                    @if ($s->observasi_file == "")
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #dc3545;" class="badge badge-pill badge-primary">
                                                                                                File belum diupload
                                                                                            </span>
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="#">
                                                                                            <span style="border:none;background: #28a745;" class="badge badge-pill badge-primary">
                                                                                                File sudah diupload
                                                                                            </span>
                                                                                        </a>
                                                                                        <a href="/files/{{$s->observasi_file}}">
                                                                                            <span style="border:none;background: #00A7E6;" class="badge badge-pill badge-primary">
                                                                                                Unduh File
                                                                                            </span>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $display = "display:none";
                                                                            @endphp
                                                                        @endif
                                                                        @if ($s->isian == 2)
                                                                            <div class="form-group row mb-4">
                                                                                <label class="radio-inline col-sm-3">
                                                                                    Skor
                                                                                </label>
                                                                                <label class="radio-inline col-sm-1">
                                                                                    <input value="0" type="radio"
                                                                                        name="skor[{{ $s->id }}]"
                                                                                        @if ($s->skor == 0) checked @endif>
                                                                                    0
                                                                                </label>
                                                                                <label class="radio-inline col-sm-1">
                                                                                    <input value="1" type="radio"
                                                                                        name="skor[{{ $s->id }}]"
                                                                                        @if ($s->skor == 1) checked @endif>
                                                                                    1
                                                                                </label>
                                                                            </div>
                                                                        @elseif($s->isian == 5)
                                                                            <div class="form-group row mb-4">
                                                                                <label class="radio-inline col-sm-3">
                                                                                    Skor
                                                                                </label>
                                                                                <label class="radio-inline col-sm">
                                                                                    <input value="0" type="radio"
                                                                                        name="skor[{{ $s->id }}]"
                                                                                        @if ($s->skor == 0) checked @endif>
                                                                                    0
                                                                                </label>
                                                                                <label class="radio-inline col-sm">
                                                                                    <input value="0.25" type="radio"
                                                                                        name="skor[{{ $s->id }}]"
                                                                                        @if ($s->skor == 0.25) checked @endif>
                                                                                    0.25
                                                                                </label>
                                                                                <label class="radio-inline col-sm">
                                                                                    <input value="0.5" type="radio"
                                                                                        name="skor[{{ $s->id }}]"
                                                                                        @if ($s->skor == 0.5) checked @endif>
                                                                                    0.5
                                                                                </label>
                                                                                <label class="radio-inline col-sm">
                                                                                    <input value="0.75" type="radio"
                                                                                        name="skor[{{ $s->id }}]"
                                                                                        @if ($s->skor == 0.75) checked @endif>
                                                                                    0.75
                                                                                </label>
                                                                                <label class="radio-inline col-sm">
                                                                                    <input value="1" type="radio"
                                                                                        name="skor[{{ $s->id }}]"
                                                                                        @if ($s->skor == 1) checked @endif>
                                                                                    1
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                        <hr>
                                                                    @endif
                                                                @endforeach
                                                                <div class="text-end mt-2">
                                                                    <button style="border:none;background: #00A7E6;"
                                                                        type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <td class="text-center">
                                                @for ($i = 1; $i <= 4; $i++)
                                                    @if ($i <= $f->tertimbang)
                                                        <svg style="color: gold;" class="icon-15" width="15"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.9184 14.32C17.6594 14.571 17.5404 14.934 17.5994 15.29L18.4884 20.21C18.5634 20.627 18.3874 21.049 18.0384 21.29C17.6964 21.54 17.2414 21.57 16.8684 21.37L12.4394 19.06C12.2854 18.978 12.1144 18.934 11.9394 18.929H11.6684C11.5744 18.943 11.4824 18.973 11.3984 19.019L6.96839 21.34C6.74939 21.45 6.50139 21.489 6.25839 21.45C5.66639 21.338 5.27139 20.774 5.36839 20.179L6.25839 15.259C6.31739 14.9 6.19839 14.535 5.93939 14.28L2.32839 10.78C2.02639 10.487 1.92139 10.047 2.05939 9.65C2.19339 9.254 2.53539 8.965 2.94839 8.9L7.91839 8.179C8.29639 8.14 8.62839 7.91 8.79839 7.57L10.9884 3.08C11.0404 2.98 11.1074 2.888 11.1884 2.81L11.2784 2.74C11.3254 2.688 11.3794 2.645 11.4394 2.61L11.5484 2.57L11.7184 2.5H12.1394C12.5154 2.539 12.8464 2.764 13.0194 3.1L15.2384 7.57C15.3984 7.897 15.7094 8.124 16.0684 8.179L21.0384 8.9C21.4584 8.96 21.8094 9.25 21.9484 9.65C22.0794 10.051 21.9664 10.491 21.6584 10.78L17.9184 14.32Z"
                                                                fill="currentColor">
                                                            </path>
                                                        </svg>
                                                    @else
                                                        <svg style="color: grey" class="icon-15" width="15"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td class="text-center bg-{{ $warna }} text-light" style="{{$arsir}}">
                                                {{ number_format($f->skor, 1, '.', '') }}%</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif --}}
        @endif
    @endforeach
@endsection
