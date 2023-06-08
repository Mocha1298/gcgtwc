<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class SubFactorController extends Controller
{
    public function home()
    {
        $master = Master::where('jenis','Sub')->get();
        $faktor = Master::where('jenis','Faktor')->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'faktor'=>$faktor
        ];
        return view('master.sub',$data);
    }
    public function add(Request $req)
    {
        $count = count(Master::where('jenis','Sub')->get())+1;
        $master = new Master();
        $master->nama = $req->nama;
        $master->id_parent = $req->id_parent;
        $master->urutan = $count;
        $master->jenis = "Sub";
        $master->dokumen = $req->dokumen;
        $master->kuesioner = $req->kuesioner;
        $master->observasi = $req->observasi;
        $master->wawancara = $req->wawancara;
        $master->isian = $req->isian;
        $master->skor = 0;
        $master->save();
        return redirect()->back()->with('success','Berhasil');
    }
    public function edit($id)
    {
        $master = Master::find($id);
        $faktor = Master::where('jenis','Faktor')->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'faktor'=>$faktor
        ];
        return view('edit.sub',$data);
    }
    public function update(Request $req, $id)
    {
        $master = Master::find($id);
        $master->nama = $req->nama;
        $master->id_parent = $req->id_parent;
        $master->dokumen = $req->dokumen;
        $master->kuesioner = $req->kuesioner;
        $master->observasi = $req->observasi;
        $master->wawancara = $req->wawancara;
        $master->isian = $req->isian;
        $master->save();
        return redirect('/subfaktor')->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $master->delete();
        return redirect()->back()->with('warning','Berhasil');
    }
}
