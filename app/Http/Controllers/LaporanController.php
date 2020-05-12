<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        if ($request->tgl == '' || $request->tgl == null ){
            $data['tgl'] = date('Y-m-d');
        }else{
            $data['tgl'] = $request->tgl;
        }
        $data['kategori'] = Kategori::all();

        return view('backend/laporan/index',$data);
    }
}
