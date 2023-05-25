<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Value;
use App\Models\Master;

class AspectController extends Controller
{
    public function home()
    {
        $master = Master::where('jenis','Aspek')->get();
        return view('master.aspek',['master'=>$master]);
    }
    public function add(Request $req)
    {
        $count = count(Master::where('jenis','Aspek')->get())+1;
        
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->jenis = "Aspek";
        $master->bobot = $req->bobot;
        $master->catatan = $req->catatan;
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
        return redirect('/aspek')->with(['success' => 'Pesan Berhasil']);
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $master->delete();
        return redirect('/aspek')->with(['warning' => 'Pesan Berhasil']);
    }
}