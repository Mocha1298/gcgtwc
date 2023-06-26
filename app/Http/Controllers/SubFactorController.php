<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class SubFactorController extends Controller
{
    public function home($tahun)
    {
        $master = Master::where('jenis','Sub')->where('tahun',$tahun)->get();
        $faktor = Master::where('jenis','Faktor')->where('tahun',$tahun)->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'faktor'=>$faktor,
            'tahun'=>$tahun
        ];
        return view('master.sub',$data);
    }
    public function add(Request $req,$tahun)
    {
        $count = count(Master::where('jenis','Sub')->where('tahun',$tahun)->where('id_parent',$req->id_parent)->get())+1;
        $master = new Master();
        $master->nama = $req->nama;
        $master->id_parent = $req->id_parent;
        $master->urutan = $count;
        $master->jenis = "Sub";
        $master->dokumen = $req->dokumen;
        $master->kuesioner = $req->kuesioner;
        $master->observasi = $req->observasi;
        $master->wawancara = $req->wawancara;
        $master->skor = 0;
        $master->tahun = $tahun;
        $master->isian = $req->isian;
        $master->skor = 0;
        $master->save();
        return redirect()->back()->with('success','Berhasil');
    }
    public function edit($id)
    {
        $master = Master::find($id);
        $tahun = $master->tahun;
        $faktor = Master::where('jenis','Faktor')->where('tahun',$tahun)->select('id','urutan')->get();
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
        $tahun = $master->tahun;
        return redirect('/subfaktor/'.$tahun)->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        if ($master->skor == 0 && $master->dokumen_file == "" && $master->kuesioner_file == "" && $master->wawancara_file == "" && $master->observasi_file == "") {
            $master->delete();
            return redirect()->back()->with(['warning' => 'Pesan Berhasil']);
        } else {
            return redirect()->back()->with(['info' => 'Gagal Hapus']);
        }
    }
}
