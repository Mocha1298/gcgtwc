<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class ParameterController extends Controller
{
    public function home()
    {
        $master = Master::where('jenis','Parameter')->get();
        $indikator = Master::where('jenis','Indikator')->get();
        $data = [
            'master'=>$master,
            'indikator'=>$indikator
        ];
        return view('master.parameter',$data);
    }
    public function add(Request $req)
    {
        $count = count(Master::where('jenis','Parameter')->get())+1;
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->jenis = 'Parameter';
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
        $indikator = Master::where('jenis','Indikator')->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'indikator'=>$indikator
        ];
        return view('edit.parameter',$data);
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
        return redirect('/parameter')->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $master->delete();
        return redirect()->back()->with('warning','Berhasil');
    }
}
