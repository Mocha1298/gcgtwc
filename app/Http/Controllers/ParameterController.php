<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class ParameterController extends Controller
{
    public function home($tahun)
    {
        $master = Master::where('jenis','Parameter')->where('tahun',$tahun)->get();
        $indikator = Master::where('jenis','Indikator')->where('tahun',$tahun)->get();
        $data = [
            'master'=>$master,
            'indikator'=>$indikator,
            'tahun'=>$tahun
        ];
        return view('master.parameter',$data);
    }
    public function add(Request $req,$tahun)
    {
        $count = count(Master::where('jenis','Parameter')->where('tahun',$tahun)->get())+1;
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->jenis = 'Parameter';
        $master->bobot = $req->bobot;
        $master->skor = 0;
        $master->tahun = $tahun;
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
        $tahun = $master->tahun;
        $indikator = Master::where('jenis','Indikator')->where('tahun',$tahun)->select('id','urutan')->get();
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
        $tahun = $master->tahun;
        return redirect('/parameter/'.$tahun)->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $child = Master::where('jenis','Faktor')->where('id_parent',$master->id)->get();
        if (count($child) == 0) {
            $master->delete();
            return redirect()->back()->with(['warning' => 'Pesan Berhasil']);
        } else {
            return redirect()->back()->with(['info' => 'Gagal Hapus']);
        }
    }
}
