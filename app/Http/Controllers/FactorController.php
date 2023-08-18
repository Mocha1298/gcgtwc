<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;
use DataTables;
use DB;

class FactorController extends Controller
{
    public function home($tahun)
    {
        $parameter = Master::where('jenis','Parameter')->where('tahun',$tahun)->get();
        $aspek = Master::where('jenis','Aspek')->where('tahun',$tahun)->get();
        $data = [
            'parameter'=>$parameter,
            'aspek'=>$aspek,
            'tahun'=>$tahun
        ];
        return view('master.faktor',$data);
    }
    function ajax($tahun) {
        $master = DB::select("select id,urutan,nama,
        CONCAT('Parameter ',(SELECT urutan FROM masters WHERE id = a.id_parent)) AS parent
        from masters as a where tahun = ".$tahun." and jenis = 'Faktor'");
        return DataTables::of($master)
        ->addColumn('action',function($master){
            return "<div class='flex align-items-center list-user-action'><a class='btn btn-sm btn-icon text-primary' data-bs-toggle='tooltip' href='/edit/faktor/".$master->id."' aria-label='Edit' data-bs-original-title='Edit'><span class='btn-inner'><svg class='icon-20' width='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path d='M15.1655 4.60254L19.7315 9.16854' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path></svg></span></a><a class='btn btn-sm btn-icon text-danger ' data-bs-toggle='tooltip' aria-label='Delete' data-bs-original-title='Delete' onclick='hapus('faktor',".$master->id.")'><span class='btn-inner'><svg class='icon-20' width='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='currentColor'><path d='M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path d='M20.708 6.23975H3.75' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path d='M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path></svg></span></a></div>";
        })
        ->make(true);
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
    function get_faktor($id, $tahun) {
        $faktor = Master::where('jenis','faktor')->where('tahun',$tahun)->where('id_parent',$id)->get();
        return $faktor;
    }
}
