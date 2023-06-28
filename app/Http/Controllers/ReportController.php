<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Master;
use File;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    function dashboard() {
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
    }
    function index($tahun) {
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
                if($temp_f > 0){
                    $faktor_v->skor = ($temp_f*100)/$max_s;
                }else{
                    $faktor_v->skor = 0;
                }
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
            $temp_a = 0;
            $total = 0;
            $aspek = Master::where('jenis','Aspek')->where('tahun',$tahun)->get();
            $max_a = count($aspek);
            for ($index_a=0; $index_a < $max_a; $index_a++) { 
                $indikator = Master::where('id_parent',$aspek[$index_a]->id)->get();
                $max_i = count($indikator);
                for ($index_f=0; $index_f < $max_i; $index_f++) { 
                    if ($indikator[$index_f]->keterangan == "Positif") {
                        $temp_a += $indikator[$index_f]->skor;
                    }else{
                        $temp_a -= $indikator[$index_f]->skor;
                    }
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
        if ($max_a == 0) {
            $total = 0;
        }else{
            $total = $total/$max_a;
        }
        $aspek = Master::where('jenis','Aspek')->where('tahun',$tahun)->get();
        // $aspek = DB::table('masters')->where('jenis','Aspek')->where('tahun',$tahun)->get();
        $indikator = Master::where('jenis','Indikator')->where('tahun',$tahun)->get();
        $parameter = Master::where('jenis','Parameter')->where('tahun',$tahun)->get();
        $faktor = Master::where('jenis','Faktor')->where('tahun',$tahun)->get();
        $sub = Master::where('jenis','Sub')->where('tahun',$tahun)->get();

        // return $sub;
        $data = [
            'aspek'=>$aspek,
            'indikator'=>$indikator,
            'parameter'=>$parameter,
            'faktor'=>$faktor,
            'sub'=>$sub,
            'total'=>$total,
            'tahun'=>$tahun
        ];
        // $indikator = [];
        // $count_ind = 0;
        // for ($i=0; $i < count($aspek); $i++) { 
        //     $data = DB::table('masters')->where('id_parent',$aspek[$i]->id)->get()->toArray();
        //     $count_ind = count($data);
        //     for ($i1=0; $i1 < $count_ind; $i1++) {
        //         array_push($indikator,$data[$i1]);
        //     }
        // }
        // dd($indikator);
        // return count($indikator);
        // $parameter = [];
        // $count_par = 0;
        // for ($i=0; $i < count($indikator); $i++) { 
        //     $data = DB::table('masters')->where('id_parent',$indikator[$i]->id)->get()->toArray();
        //     $count_par = count($data);
        //     for ($i1=0; $i1 < $count_par; $i1++) {
        //         array_push($parameter,$data[$i1]);
        //     }
        // }
        // return $parameter;
        return view('table',$data);
    }
    function each_value(Request $req,$id) {
        $ids = DB::table('masters')->select('id')->where('id_parent',$id)->get();
        $count = count($ids);
        for($i = 0;$i < $count;$i++){
            $master = Master::find($ids[$i]->id);
            if($master->dokumen == 1){
                if ($req->all('dokumen'.$ids[$i]->id)['dokumen'.$ids[$i]->id] != null) {
                    if ($master->dokumen_file != "") {
                        File::delete('files/'.$master->dokumen_file);
                        $file = $req->all('dokumen'.$ids[$i]->id)['dokumen'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        $file->move(public_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->dokumen_file = $filename;
                        $master->save();
                    }else{
                        $file = $req->all('dokumen'.$ids[$i]->id)['dokumen'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        // return storage_path();
                        // if ($file->move(storage_path('files'), $filename)) {//simpan file lokal dengan nama $filename
                        //     return "Berhasil";
                        // }else{
                        //     return "Gagal";
                        // }
                        $file->move(storage_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->dokumen_file = $filename;
                        $master->save();
                    }
                }
            }
            $master = Master::find($ids[$i]->id);
            if($master->kuesioner == 1){
                if ($req->all('kuesioner'.$ids[$i]->id)['kuesioner'.$ids[$i]->id] != null) {
                    if ($master->kuesioner_file != "") {
                        File::delete('files/'.$master->kuesioner_file);
                        $file = $req->all('kuesioner'.$ids[$i]->id)['kuesioner'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        $file->move(public_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->kuesioner_file = $filename;
                        $master->save();
                    }else{
                        $file = $req->all('kuesioner'.$ids[$i]->id)['kuesioner'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        $file->move(public_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->kuesioner_file = $filename;
                        $master->save();
                    }
                }
            }
            $master = Master::find($ids[$i]->id);
            if($master->wawancara == 1){
                if ($req->all('wawancara'.$ids[$i]->id)['wawancara'.$ids[$i]->id] != null) {
                    if ($master->wawancara_file != "") {
                        File::delete('files/'.$master->wawancara_file);
                        $file = $req->all('wawancara'.$ids[$i]->id)['wawancara'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        $file->move(public_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->wawancara_file = $filename;
                        $master->save();
                    }else{
                        $file = $req->all('wawancara'.$ids[$i]->id)['wawancara'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        $file->move(public_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->wawancara_file = $filename;
                        $master->save();
                    }
                }
            }
            $master = Master::find($ids[$i]->id);
            if($master->observasi == 1){
                if ($req->all('observasi'.$ids[$i]->id)['observasi'.$ids[$i]->id] != null) {
                    if ($master->observasi_file != "") {
                        File::delete('files/'.$master->observasi_file);
                        $file = $req->all('observasi'.$ids[$i]->id)['observasi'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        $file->move(public_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->observasi_file = $filename;
                        $master->save();
                    }else{
                        $file = $req->all('observasi'.$ids[$i]->id)['observasi'.$ids[$i]->id];
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($j = 0; $j < 10; $j++) {
                            $randomString .= $characters[random_int(0, $charactersLength - 1)];
                        }
                        $filename = $randomString.'.'.$file->getClientOriginalExtension();//nama file
                        $file->move(public_path('files'), $filename);//simpan file lokal dengan nama $filename
                        $master->observasi_file = $filename;
                        $master->save();
                    }
                }
            }
            $master = Master::find($ids[$i]->id);
            $tahun = $master->tahun;
            $master->skor = $req->skor[$ids[$i]->id];
            $master->save();
        }
        return redirect('/report/'.$tahun)->with('success','Berhasil');
    }
    function getdet($id,$type) {
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
    }
    function note(Request $req, $type,$id) {
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
    }
}
