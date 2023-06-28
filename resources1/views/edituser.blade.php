@extends('layout')
@section('title', 'Edit User')
@section('user', 'active')
@section('greeting')
    <h1>Edit User</h1>
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
        #aspek {
            transition: all 5s;
        }
        select.form-select:disabled{
            background-color: #4949496c;
            color: #fff;
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
        function cek() {
            var selectBox = document.getElementById("exampleFormControlSelect1");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            if (selectedValue == "Admin") {
                document.getElementById("exampleFormControlSelect2").disabled = true;
                document.getElementById("exampleFormControlSelect2").required = false;
                document.getElementById('default').selected = true;
                // console.log(selectBox);
            } else {
                document.getElementById("exampleFormControlSelect2").disabled = false;
                document.getElementById("exampleFormControlSelect2").required = true;
            }
        }
    </script>

    @if (old('role') == 'User' || $data->role == 'User')
        <script>
            document.getElementById("exampleFormControlSelect2").disabled = false;
            document.getElementById("exampleFormControlSelect2").required = true;
        </script>
    @endif
@endsection



@section('main')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <form method="POST" action="/profile/{{ $data->id }}">
                            @csrf
                            <div class="modal-body">
                                {{-- NAMA --}}
                                <div class="form-group">
                                    {{ $data->name }}
                                    <label for="name" class="form-label">Nama</label>
                                    <input class="form-control" id="name" type="text" name="name"
                                        value="{{ $data->name, old('name') }}" required autofocus autocomplete="name"
                                        placeholder="Nama">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>
                                {{-- EMAIL --}}
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                        value="{{ $data->email, old('email') }}" required placeholder="Email">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>
                                {{-- PILIH POSISI --}}
                                <div class="form-group">
                                    <label for="text" class="form-label">Pilih Posisi</label>
                                    <div class="form-group">
                                        <select class="form-select" id="exampleFormControlSelect1" onchange="cek()"
                                            name="role" required>
                                            <option selected disabled="">Pilih Posisi</option>
                                            @if (old('role') == 'Admin' || $data->role == 'Admin')
                                                <option value="Admin" selected>Admin</option>
                                            @else
                                                <option value="Admin">Admin</option>
                                            @endif
                                            @if (old('role') == 'User' || $data->role == 'User')
                                                <option value="User" selected>User</option>
                                            @else
                                                <option value="User">User</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                {{-- PILIH ASPEK --}}
                                <div class="form-group" id="aspek">
                                    <label for="text" class="form-label">Pilih Aspek</label>
                                    <div class="form-group">
                                        <select disabled class="form-select" id="exampleFormControlSelect2"
                                            name="id_master">
                                            <option id="default" selected="" disabled="">Pilih Aspek</option>
                                            @foreach ($aspek as $item)
                                                <option @if ($data->id_master == $item->id) selected @endif
                                                    value="{{ $item->id }}">Aspek {{ $item->urutan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end mt-4 mb-4">
                                    <button style="border:none;background: #00A7E6;" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
