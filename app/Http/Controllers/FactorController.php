<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class FactorController extends Controller
{
    public function home()
    {
        $master = Master::where('jenis','Faktor')->get();
        $parameter = Master::where('jenis','Parameter')->get();
        $data = [
            'master'=>$master,
            'parameter'=>$parameter
        ];
        return view('master.faktor',$data);
    }
    public function add(Request $req)
    {
        $count = count(Master::where('jenis','Faktor')->get())+1;
        $master = new Master();
        $master->urutan = $count;
        $master->nama = $req->nama;
        $master->keterangan = $req->keterangan;
        $master->jenis = 'Faktor';
        $master->catatan = $req->catatan;
        $master->id_parent = $req->id_parent;
        $master->save();
        return redirect()->back()->with('success','Berhasil');
    }
    public function edit($id)
    {
        $master = Master::find($id);
        $parameter = Master::where('jenis','Parameter')->select('id','urutan')->get();
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
        return redirect('/faktor')->with('success','Berhasil');
    }
    public function delete($id)
    {
        $master = Master::find($id);
        $master->delete();
        return redirect()->back()->with('warning','Berhasil');
    }
}
