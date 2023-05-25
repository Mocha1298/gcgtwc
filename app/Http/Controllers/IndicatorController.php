<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class IndicatorController extends Controller
{
    public function home()
    {
        $master = Master::where('jenis','Indikator')->get();
        $aspek = Master::where('jenis','Aspek')->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'aspek'=>$aspek
        ];
        return view('master.indikator',$data);
    }
    public function add(Request $req)
    {
        $count = count(Master::where('jenis','Indikator')->get())+1;
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->jenis = 'Indikator';
        $master->bobot = $req->bobot;
        $master->catatan = $req->catatan;
        $master->analisis = $req->analisis;
        $master->rekomendasi = $req->rekomendasi;
        $master->id_parent = $req->id_parent;
        $master->save();
        return redirect()->back()->with('success','Berhasil');
    }
    public function edit($id)
    {
        $master = Master::find($id);
        $aspek = Master::where('jenis','Aspek')->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'aspek'=>$aspek
        ];
        return view('edit.indikator',$data);
    }
    public function update(Request $req, $id)
    {
        $master = Master::find($id);
        $master->nama = $req->nama;
        $master->bobot = $req->bobot;
        $master->catatan = $req->catatan;
        $master->analisis = $req->analisis;
        $master->rekomendasi = $req->rekomendasi;
        $master->id_parent = $req->id_parent;
        $master->save();
        return redirect('/indikator')->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $master->delete();
        return redirect()->back()->with('warning','Berhasil');
    }
}
