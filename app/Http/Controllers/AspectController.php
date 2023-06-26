<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Value;
use App\Models\Master;

class AspectController extends Controller
{
    public function home($tahun)
    {
        $master = Master::where('jenis','Aspek')->where('tahun',$tahun)->get();
        // return $tahun;
        return view('master.aspek',['master'=>$master,'tahun'=>$tahun]);
    }
    public function add(Request $req,$tahun)
    {
        $count = count(Master::where('jenis','Aspek')->where('tahun',$tahun)->get())+1;
        
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->jenis = "Aspek";
        $master->bobot = $req->bobot;
        $master->skor = 0;
        $master->catatan = $req->catatan;
        $master->tahun = $tahun;
        $master->save();
        return redirect()->back()->with(['success' => 'Pesan Berhasil']);
    }
    public function edit($id)
    {
        $master = Master::find($id);
        // return $master;
        return view('edit.aspek',['master'=>$master]);
    }
    public function update(Request $req,$id)
    {
        $master = Master::find($id);
        $master->nama = $req->nama;
        $master->bobot = $req->bobot;
        $master->catatan = $req->catatan;
        $master->save();
        $tahun = $master->tahun;
        return redirect('/aspek/'.$tahun)->with(['success' => 'Pesan Berhasil']);
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $child = Master::where('jenis','Indikator')->where('id_parent',$master->id)->get();
        if (count($child) == 0) {
            $master->delete();
            return redirect()->back()->with(['warning' => 'Pesan Berhasil']);
        } else {
            return redirect()->back()->with(['info' => 'Gagal Hapus']);
        }
    }
}