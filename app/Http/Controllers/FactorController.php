<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class FactorController extends Controller
{
    public function home($tahun)
    {
        $master = Master::where('jenis','Faktor')->where('tahun',$tahun)->get();
        $parameter = Master::where('jenis','Parameter')->where('tahun',$tahun)->get();
        $data = [
            'master'=>$master,
            'parameter'=>$parameter,
            'tahun'=>$tahun
        ];
        return view('master.faktor',$data);
    }
    public function add(Request $req,$tahun)
    {
        $count = count(Master::where('jenis','Faktor')->where('tahun',$tahun)->where('id_parent',$req->id_parent)->get())+1;
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->keterangan = $req->keterangan;
        $master->jenis = 'Faktor';
        $master->catatan = $req->catatan;
        $master->skor = 0;
        $master->tahun = $tahun;
        $master->id_parent = $req->id_parent;
        $master->save();
        return redirect()->back()->with('success','Berhasil');
    }
    public function edit($id)
    {
        $master = Master::find($id);
        $tahun = $master->tahun;
        $parameter = Master::where('jenis','Parameter')->where('tahun',$tahun)->select('id','urutan')->get();
        $data = [
            'master'=>$master,
            'parameter'=>$parameter
        ];
        return view('edit.faktor',$data);
    }
    public function update(Request $req, $id)
    {
        $master = Master::find($id);
        $master->nama = $req->nama;
        $master->keterangan = $req->keterangan;
        $master->catatan = $req->catatan;
        $master->id_parent = $req->id_parent;
        $master->save();
        $tahun = $master->tahun;
        return redirect('/faktor/'.$tahun)->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $child = Master::where('jenis','Sub')->where('id_parent',$master->id)->get();
        if (count($child) == 0) {
            $master->delete();
            return redirect()->back()->with(['warning' => 'Pesan Berhasil']);
        } else {
            return redirect()->back()->with(['info' => 'Gagal Hapus']);
        }
    }
}
