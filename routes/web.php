<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Master;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $id = Auth::user()->id_master;
        $role = Auth::user()->role;
        if ($role == "Admin") {
            $aspek = Master::where('jenis','Aspek')->get();
            $indikator = 0;
        }else{
            $aspek = Master::find($id);
            $indikator = Master::where('id_parent',$id)->get();
        }

        $data = [
            'aspek'=>$aspek,
            'indikator'=>$indikator,
        ];
        return view('dashboard',$data);
    });

    Route::get('/dashboard', function () {
        $sub = Master::where('jenis','Sub')->get();
        $faktor = Master::where('jenis','Faktor')->get();
        $parameter = Master::where('jenis','Parameter')->get();
        $indikator = Master::where('jenis','Indikator')->get();
        $aspek = Master::where('jenis','Aspek')->get();

        $data = [
            'aspek'=>$aspek,
            'indikator'=>$indikator,
            'parameter'=>$parameter,
            'faktor'=>$faktor,
            'sub'=>$sub,
            'total'=>$total
        ];
        return view('dashboard',$data);
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile/{id}', [ProfileController::class, 'edit']);
    Route::post('/profile/{id}', [ProfileController::class, 'update']);
    Route::get('/delete/profile/{id}', [ProfileController::class, 'destroy']);


    // ROUTE ASPEK start
        Route::get('/aspek','App\Http\Controllers\AspectController@home');
        Route::post('/aspek','App\Http\Controllers\AspectController@add');
        Route::get('/edit/aspek/{id}','App\Http\Controllers\AspectController@edit');
        Route::post('/edit/aspek/{id}','App\Http\Controllers\AspectController@update');
        Route::get('/delete/aspek/{id}','App\Http\Controllers\AspectController@delete');
    // ROUTE ASPEK end
    // ROUTE INDIKATOR start
        Route::get('/indikator','App\Http\Controllers\IndicatorController@home');
        Route::post('/indikator','App\Http\Controllers\IndicatorController@add');
        Route::get('/edit/indikator/{id}','App\Http\Controllers\IndicatorController@edit');
        Route::post('/edit/indikator/{id}','App\Http\Controllers\IndicatorController@update');
        Route::get('/delete/indikator/{id}','App\Http\Controllers\IndicatorController@delete');
    // ROUTE INDIKATOR end
    // ROUTE PARAMETER start
        Route::get('/parameter','App\Http\Controllers\ParameterController@home');
        Route::post('/parameter','App\Http\Controllers\ParameterController@add');
        Route::get('/edit/parameter/{id}','App\Http\Controllers\ParameterController@edit');
        Route::post('/edit/parameter/{id}','App\Http\Controllers\ParameterController@update');
        Route::get('/delete/parameter/{id}','App\Http\Controllers\ParameterController@delete');
    // ROUTE PARAMETER end
    // ROUTE FAKTOR start
        Route::get('/faktor','App\Http\Controllers\FactorController@home');
        Route::post('/faktor','App\Http\Controllers\FactorController@add');
        Route::get('/edit/faktor/{id}','App\Http\Controllers\FactorController@edit');
        Route::post('/edit/faktor/{id}','App\Http\Controllers\FactorController@update');
        Route::get('/delete/faktor/{id}','App\Http\Controllers\FactorController@delete');
    // ROUTE FAKTOR end
    // ROUTE SUB start
        Route::get('/subfaktor','App\Http\Controllers\SubFactorController@home');
        Route::post('/subfaktor','App\Http\Controllers\SubFactorController@add');
        Route::get('/edit/subfaktor/{id}','App\Http\Controllers\SubFactorController@edit');
        Route::post('/edit/subfaktor/{id}','App\Http\Controllers\SubFactorController@update');
        Route::get('/delete/subfaktor/{id}','App\Http\Controllers\SubFactorController@delete');
    // ROUTE SUB end


    Route::get('/report', function () {
        // research section
            $temp_f = 0;
            $faktor = Master::where('jenis','Faktor')->get();
            $max_f = count($faktor);
            for ($index_f=0; $index_f < $max_f; $index_f++) { 
                $sub = Master::where('id_parent',$faktor[$index_f]->id)->get();
                $max_s = count($sub);
                for ($index_s=0; $index_s < $max_s; $index_s++) { 
                    $temp_f += $sub[$index_s]->skor;
                }
                $faktor_v = Master::find($faktor[$index_f]->id);
                $faktor_v->skor = ($temp_f*100)/$max_s;
                if($faktor_v->skor%25 >0){
                $faktor_v->tertimbang = $faktor_v->skor/25+1;
                }else{
                $faktor_v->tertimbang = $faktor_v->skor/25;
                }
                $faktor_v->save();
                $temp_f = 0;
            }
            // return $faktor;

            $temp_p = 0;
            $parameter = Master::where('jenis','Parameter')->get();
            $max_p = count($parameter);
            for ($index_p=0; $index_p < $max_p; $index_p++) { 
                $faktor = Master::where('id_parent',$parameter[$index_p]->id)->get();
                $max_f = count($faktor);
                for ($index_f=0; $index_f < $max_f; $index_f++) { 
                    $temp_p += $faktor[$index_f]->skor;
                }
                $parameter_v = Master::find($parameter[$index_p]->id);
                if($temp_p > 0){
                    $parameter_v->skor = $temp_p/$max_f;
                }else{
                    $parameter_v->skor = 0;
                }
                $parameter_v->tertimbang = ($parameter_v->skor/100)*$parameter_v->bobot;
                $parameter_v->save();
                $temp_p = 0;
            }


            $temp_i = 0;
            $indikator = Master::where('jenis','Indikator')->get();
            $max_i = count($indikator);
            for ($index_i=0; $index_i < $max_i; $index_i++) { 
                $parameter = Master::where('id_parent',$indikator[$index_i]->id)->get();
                $max_p = count($parameter);
                for ($index_f=0; $index_f < $max_p; $index_f++) { 
                    $temp_i += $parameter[$index_f]->skor;
                }
                $indikator_v = Master::find($indikator[$index_i]->id);
                if ($temp_i > 0) {
                    $indikator_v->skor = $temp_i/$max_p;
                }else{
                    $indikator_v->skor = 0;
                }
                $indikator_v->tertimbang = ($indikator_v->skor/100)*$indikator_v->bobot;
                $indikator_v->save();
                $temp_i = 0;
            }

            
            $temp_a = 0;
            $total = 0;
            $aspek = Master::where('jenis','Aspek')->get();
            $max_a = count($aspek);
            for ($index_a=0; $index_a < $max_a; $index_a++) { 
                $indikator = Master::where('id_parent',$aspek[$index_a]->id)->get();
                $max_i = count($indikator);
                for ($index_f=0; $index_f < $max_i; $index_f++) { 
                    $temp_a += $indikator[$index_f]->skor;
                }
                $aspek_v = Master::find($aspek[$index_a]->id);
                if ($temp_a > 0) {
                    $aspek_v->skor = $temp_a/$max_i;
                }else{
                    $aspek_v->skor = 0;
                }
                $aspek_v->tertimbang = ($aspek_v->skor/100)*$aspek_v->bobot;
                $aspek_v->save();
                $total += $aspek_v->skor;
                $temp_a = 0;
            }
        //research section
        $total = $total/$max_a;
        $sub = Master::where('jenis','Sub')->get();
        $faktor = Master::where('jenis','Faktor')->get();
        $parameter = Master::where('jenis','Parameter')->get();
        $indikator = Master::where('jenis','Indikator')->get();
        $aspek = Master::where('jenis','Aspek')->get();

        $data = [
            'aspek'=>$aspek,
            'indikator'=>$indikator,
            'parameter'=>$parameter,
            'faktor'=>$faktor,
            'sub'=>$sub,
            'total'=>$total
        ];
        // return $data;
        return view('table',$data);
    });
    Route::post('/summary/{id}', function(Request $req, $id){
        $ids = DB::table('masters')->select('id')->where('id_parent',$id)->get();
        // $master = Master::where('id_parent',$id)->where('urutan',1)->get();
        $count = count($ids);
        // return $ids[1]->id;
        // return $req;
        for($i = 0;$i < $count;$i++){
            $master = Master::find($ids[$i]->id);
            if($master->dokumen == 1){
                $master->dokumen_file = $req->dokumen[$ids[$i]->id];
            }
            if($master->kuesioner == 1){
                $master->kuesioner_file = $req->kuesioner[$ids[$i]->id];
            }
            if($master->wawancara == 1){
                $master->wawancara_file = $req->wawancara[$ids[$i]->id];
            }
            if($master->observasi == 1){
                $master->observasi_file = $req->observasi[$ids[$i]->id];
            }
            $master->skor = $req->skor[$ids[$i]->id];
            $master->save();
        }
        return redirect('/report')->with('success','Berhasil');
    });
    Route::get('/index', function () {
        return view('layout');
    });

    // User
    Route::get('/user',[ProfileController::class, 'show'])->name('user');
    Route::get('/newuser',[ProfileController::class, 'create'])->name('create');
    Route::post('/newuser',[ProfileController::class, 'store'])->name('store');

    Route::get('getdet/{id}/{type}',function ($id,$type)
    {
        if($type == 'Aspek' || $type == 'Faktor'){
            $detail = Master::where('id',$id)->select('id','nama','urutan','catatan')->first();
        }elseif($type == 'Indikator' ||$type == 'Parameter'){
            $detail = Master::where('id',$id)->select('id','nama','urutan','catatan','rekomendasi','analisis')->first();
        }
        $data = [
            'detail'=>$detail,
            'type'=>$type,
        ];
        return $data;
    });
    Route::post('/summary/{type}/{id}', function (Request $req,$type,$id)
    {
        if($type == 'Aspek' || $type == 'Faktor'){
            $detail = Master::find($id);
            $detail->catatan = $req->catatan;
            $detail->save();
            return redirect()->back()->with('success','Berhasil');
        }elseif($type == 'Indikator' || $type == 'Parameter'){
            $detail = Master::find($id);
            $detail->catatan = $req->catatan;
            $detail->rekomendasi = $req->rekomendasi;
            $detail->analisis = $req->analisis;
            $detail->save();
            return redirect()->back()->with('success','Berhasil');
        }
    });
});

require __DIR__.'/auth.php';
