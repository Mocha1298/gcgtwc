@extends('report')

@php
    $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI'];
@endphp

@section('table')
    @foreach ($aspek as $a)
        <tr data-node-id="{{ $a->id }}" class="table-danger">
            <td><a href="#"> Aspek {{ $romawi[$a->urutan - 1] }}</a></td>
            <td>{{ $a->bobot }}</td>
            <td>{{ $a->tertimbang }}</td>
            <td>90%</td>
        </tr>
        @foreach ($indikator as $i)
            @if ($a->id == $i->id_parent)
                <tr data-node-id="{{ $a->id }}.{{ $i->id }}" data-node-pid="{{ $a->id }}"
                    class="table-info">
                    <td><a href="#"> Indikator {{ $i->urutan }}</a></td>
                    <td>{{ $i->bobot }}</td>
                    <td>{{ $i->tertimbang }}</td>
                    <td>90%</td>
                </tr>
                @foreach ($parameter as $p)
                    @if ($i->id == $p->id_parent)
                        <tr data-node-id="{{ $a->id }}.{{ $i->id }}.{{ $p->id }}"
                            data-node-pid="{{ $a->id }}.{{ $i->id }}" class="table-warning">
                            <td><a href="#"> Parameter {{ $p->urutan }}</a>
                            </td>
                            <td>{{ $p->bobot }}</td>
                            <td>{{ $p->tertimbang }}</td>
                            <td>90%</td>
                        </tr>
                        @foreach ($faktor as $f)
                            @if ($p->id == $f->id_parent)
                                <tr data-node-id="{{ $a->id }}.{{ $i->id }}.{{ $p->id }}.{{ $f->id }}"
                                    data-node-pid="{{ $a->id }}.{{ $i->id }}.{{ $p->id }}">
                                    <td><a href="#"> Faktor
                                            {{ $f->urutan }}</a></td>
                                    <td>
                                        <a class="btn btn-sm btn-icon text-info" data-bs-toggle="modal"
                                            data-bs-target="#form{{ $f->id }}">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
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
                                                    <div class="modal-body">
                                                        @foreach ($sub as $s)
                                                            @if ($f->id == $s->id_parent)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="exampleRadios" id="exampleRadios1"
                                                                        value="option1" checked>
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        Default radio
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="exampleRadios" id="exampleRadios2"
                                                                        value="option2">
                                                                    <label class="form-check-label" for="exampleRadios2">
                                                                        Second default radio
                                                                    </label>
                                                                </div>
                                                                <div class="form-check disabled">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="exampleRadios" id="exampleRadios3"
                                                                        value="option3" disabled>
                                                                    <label class="form-check-label" for="exampleRadios3">
                                                                        Disabled radio
                                                                    </label>
                                                                </div>
                                                                {{-- <div class="form-group row">
                                                                    <label
                                                                        class="control-label col-sm-3 align-self-center mb-0"
                                                                        for="email">Nama:</label>
                                                                    <div class="col-sm-9">
                                                                        <label
                                                                            class="control-label col-sm-3 align-self-center mb-0"
                                                                            for="email">{{ $s->nama }}</label>
                                                                    </div>
                                                                </div>
                                                                @if ($s->dokumen == 1)
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="control-label col-sm-3 align-self-center mb-0"
                                                                            for="dokumen">Dokumen:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                id="dokumen" placeholder="Link Dokumen">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($s->kuesioner == 1)
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="control-label col-sm-3 align-self-center mb-0"
                                                                            for="kuesioner">Kuesioner:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                id="kuesioner" placeholder="Link Kuesioner">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($s->wawancara == 1)
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="control-label col-sm-3 align-self-center mb-0"
                                                                            for="wawancara">Wawancara:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                id="wawancara" placeholder="Link Wawancara">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($s->observasi == 1)
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="control-label col-sm-3 align-self-center mb-0"
                                                                            for="observasi">Observasi:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                id="observasi" placeholder="Link Observasi">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($s->isian == 2)
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3" for="">Skor</label>
                                                                        <div class="col-sm-9">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                @elseif($s->isian == 5)
                                                                    <div class="form-group">
                                                                        <div class="form-check d-block">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="flexRadioDefault" id="pilihannol">
                                                                            <label class="form-check-label"
                                                                                for="pilihannol">
                                                                                0
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check d-block">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="flexRadioDefault"
                                                                                id="pilihannolkomadualima" checked="">
                                                                            <label class="form-check-label"
                                                                                for="pilihannolkomadualima">
                                                                                0.25
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check d-block">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="flexRadioDefault"
                                                                                id="pilihannolkomalima" checked="">
                                                                            <label class="form-check-label"
                                                                                for="pilihannolkomalima">
                                                                                0.5
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check d-block">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="flexRadioDefault"
                                                                                id="pilhannolkomatujuhlima"
                                                                                checked="">
                                                                            <label class="form-check-label"
                                                                                for="pilhannolkomatujuhlima">
                                                                                0.75
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check d-block">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="flexRadioDefault" id="pilihansatu"
                                                                                checked="">
                                                                            <label class="form-check-label"
                                                                                for="pilihansatu">
                                                                                1
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endif --}}
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="text-start mt-2">
                                                            <button style="border:none;background: #00A7E6;" type="submit"
                                                                class="btn btn-primary"
                                                                data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <svg style="color: grey;" class="icon-20" width="20" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.9184 14.32C17.6594 14.571 17.5404 14.934 17.5994 15.29L18.4884 20.21C18.5634 20.627 18.3874 21.049 18.0384 21.29C17.6964 21.54 17.2414 21.57 16.8684 21.37L12.4394 19.06C12.2854 18.978 12.1144 18.934 11.9394 18.929H11.6684C11.5744 18.943 11.4824 18.973 11.3984 19.019L6.96839 21.34C6.74939 21.45 6.50139 21.489 6.25839 21.45C5.66639 21.338 5.27139 20.774 5.36839 20.179L6.25839 15.259C6.31739 14.9 6.19839 14.535 5.93939 14.28L2.32839 10.78C2.02639 10.487 1.92139 10.047 2.05939 9.65C2.19339 9.254 2.53539 8.965 2.94839 8.9L7.91839 8.179C8.29639 8.14 8.62839 7.91 8.79839 7.57L10.9884 3.08C11.0404 2.98 11.1074 2.888 11.1884 2.81L11.2784 2.74C11.3254 2.688 11.3794 2.645 11.4394 2.61L11.5484 2.57L11.7184 2.5H12.1394C12.5154 2.539 12.8464 2.764 13.0194 3.1L15.2384 7.57C15.3984 7.897 15.7094 8.124 16.0684 8.179L21.0384 8.9C21.4584 8.96 21.8094 9.25 21.9484 9.65C22.0794 10.051 21.9664 10.491 21.6584 10.78L17.9184 14.32Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg style="color: grey;" class="icon-20" width="20" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.9184 14.32C17.6594 14.571 17.5404 14.934 17.5994 15.29L18.4884 20.21C18.5634 20.627 18.3874 21.049 18.0384 21.29C17.6964 21.54 17.2414 21.57 16.8684 21.37L12.4394 19.06C12.2854 18.978 12.1144 18.934 11.9394 18.929H11.6684C11.5744 18.943 11.4824 18.973 11.3984 19.019L6.96839 21.34C6.74939 21.45 6.50139 21.489 6.25839 21.45C5.66639 21.338 5.27139 20.774 5.36839 20.179L6.25839 15.259C6.31739 14.9 6.19839 14.535 5.93939 14.28L2.32839 10.78C2.02639 10.487 1.92139 10.047 2.05939 9.65C2.19339 9.254 2.53539 8.965 2.94839 8.9L7.91839 8.179C8.29639 8.14 8.62839 7.91 8.79839 7.57L10.9884 3.08C11.0404 2.98 11.1074 2.888 11.1884 2.81L11.2784 2.74C11.3254 2.688 11.3794 2.645 11.4394 2.61L11.5484 2.57L11.7184 2.5H12.1394C12.5154 2.539 12.8464 2.764 13.0194 3.1L15.2384 7.57C15.3984 7.897 15.7094 8.124 16.0684 8.179L21.0384 8.9C21.4584 8.96 21.8094 9.25 21.9484 9.65C22.0794 10.051 21.9664 10.491 21.6584 10.78L17.9184 14.32Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg style="color: grey;" class="icon-20" width="20" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.9184 14.32C17.6594 14.571 17.5404 14.934 17.5994 15.29L18.4884 20.21C18.5634 20.627 18.3874 21.049 18.0384 21.29C17.6964 21.54 17.2414 21.57 16.8684 21.37L12.4394 19.06C12.2854 18.978 12.1144 18.934 11.9394 18.929H11.6684C11.5744 18.943 11.4824 18.973 11.3984 19.019L6.96839 21.34C6.74939 21.45 6.50139 21.489 6.25839 21.45C5.66639 21.338 5.27139 20.774 5.36839 20.179L6.25839 15.259C6.31739 14.9 6.19839 14.535 5.93939 14.28L2.32839 10.78C2.02639 10.487 1.92139 10.047 2.05939 9.65C2.19339 9.254 2.53539 8.965 2.94839 8.9L7.91839 8.179C8.29639 8.14 8.62839 7.91 8.79839 7.57L10.9884 3.08C11.0404 2.98 11.1074 2.888 11.1884 2.81L11.2784 2.74C11.3254 2.688 11.3794 2.645 11.4394 2.61L11.5484 2.57L11.7184 2.5H12.1394C12.5154 2.539 12.8464 2.764 13.0194 3.1L15.2384 7.57C15.3984 7.897 15.7094 8.124 16.0684 8.179L21.0384 8.9C21.4584 8.96 21.8094 9.25 21.9484 9.65C22.0794 10.051 21.9664 10.491 21.6584 10.78L17.9184 14.32Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg style="color: grey" class="icon-20" width="20" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </td>
                                    <td>90%</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach
    @endforeach
@endsection
