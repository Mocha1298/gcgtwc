<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class IndicatorController extends Controller
{
    public function home($tahun)
    {
        $master = Master::where('jenis','Indikator')->where('tahun',$tahun)->get();
        $aspek = Master::where('jenis','Aspek')->where('tahun',$tahun)->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'aspek'=>$aspek,
            'tahun'=>$tahun
        ];
        return view('master.indikator',$data);
    }
    public function add(Request $req,$tahun)
    {
        $count = count(Master::where('jenis','Indikator')->where('tahun',$tahun)->get())+1;
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->keterangan = $req->keterangan;
        $master->jenis = 'Indikator';
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
        $aspek = Master::where('jenis','Aspek')->where('tahun',$tahun)->select('id','urutan')->get();
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
        $master->keterangan = $req->keterangan;
        $master->bobot = $req->bobot;
        $master->catatan = $req->catatan;
        $master->analisis = $req->analisis;
        $master->rekomendasi = $req->rekomendasi;
        $master->id_parent = $req->id_parent;
        $master->save();
        $tahun = $master->tahun;
        return redirect('/indikator/'.$tahun)->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $child = Master::where('jenis','Parameter')->where('id_parent',$master->id)->get();
        if (count($child) == 0) {
            $master->delete();
            return redirect()->back()->with(['warning' => 'Pesan Berhasil']);
        } else {
            return redirect()->back()->with(['info' => 'Gagal Hapus']);
        }
    }
    function get_indikator($id,$tahun) {
        $indikator = Master::where('jenis','Indikator')->where('tahun',$tahun)->where('id_parent',$id)->select('id','urutan')->get();
        return $indikator;
    }
}
