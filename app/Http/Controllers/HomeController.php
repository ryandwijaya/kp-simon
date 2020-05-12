<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->tgl == '' || $request->tgl == null ){
            $data['tgl'] = date('Y-m-d');
        }else{
            $data['tgl'] = $request->tgl;
        }
        $tgl =$data['tgl'];
        $data['cpo'] = DB::table('sub_menu')
            ->leftJoin('kategori','kategori.kategori_id','=','sub_menu.menu_kategori')
            ->where('kategori.kategori_jenis','=','cpo')
            ->get();
        $data['pko'] = DB::table('sub_menu')
            ->leftJoin('kategori','kategori.kategori_id','=','sub_menu.menu_kategori')
            ->where('kategori.kategori_jenis','=','pko')
            ->get();
        $cpo = $data['cpo'];
        $pko = $data['pko'];
        foreach($cpo as $i => $item){
            if ($item->menu_table == 'data_alb'){
                $panjang = DB::table($item->menu_table)->whereDate('date_created',$tgl)->count();
                if($panjang>0){
                    $hasil = DB::table($item->menu_table)->whereDate('date_created',$tgl)->get()->sum('alb_hasil');
                    $persen[$i] = round($hasil/$panjang,3);
                }else{
                    $persen[$i] = 0;
                }
            }elseif($item->menu_table == 'data_kadar'){
                $panjang = DB::table($item->menu_table)->where('kadar_kategori',$item->kategori_id)->where('kadar_tipe',$item->menu_table_tipe)->whereDate('date_created',$tgl)->count();
                if($panjang>0){
                    $hasil = DB::table($item->menu_table)->where('kadar_kategori',$item->kategori_id)->where('kadar_tipe',$item->menu_table_tipe)->whereDate('date_created',$tgl)->get()->sum('kadar_hasil');
                    $persen[$i] = round($hasil/$panjang,3);
                }else{
                    $persen[$i] = 0;
                }
            } elseif($item->menu_table == 'data_other'){
                $panjang = DB::table($item->menu_table)->where('other_kategori',$item->kategori_id)->whereDate('date_created',$tgl)->count();
                if($panjang>0){
                    $hasil = DB::table($item->menu_table)->where('other_kategori',$item->kategori_id)->where('other_tipe',$item->menu_table_tipe)->whereDate('date_created',$tgl)->get()->sum('other_hasil');
                    $persen[$i] = round($hasil/$panjang,3);
                }else{
                    $persen[$i] = 0;
                }
            }
            else{
                $persen[$i] = 0;
            }
        }

        foreach($pko as $i => $dat){
            if($dat->menu_table == 'data_kadar'){
                $panjang = DB::table($dat->menu_table)->where('kadar_kategori',$dat->kategori_id)->where('kadar_tipe',$dat->menu_table_tipe)->whereDate('date_created',$tgl)->count();
                if($panjang>0){
                    $hasil = DB::table($dat->menu_table)->where('kadar_kategori',$dat->kategori_id)->where('kadar_tipe',$dat->menu_table_tipe)->whereDate('date_created',$tgl)->get()->sum('kadar_hasil');
                    $persen_pko[$i] = round($hasil/$panjang,3);
                }else{
                    $persen_pko[$i] = 0;
                }
            } elseif($dat->menu_table == 'data_other'){
                $panjang = DB::table($dat->menu_table)->where('other_kategori',$dat->kategori_id)->whereDate('date_created',$tgl)->count();
                if($panjang>0){
                    $hasil = DB::table($dat->menu_table)->where('other_kategori',$dat->kategori_id)->where('other_tipe',$dat->menu_table_tipe)->whereDate('date_created',$tgl)->get()->sum('other_hasil');
                    $persen_pko[$i] = round($hasil/$panjang,3);
                }else{
                    $persen_pko[$i] = 0;
                }
            }
            else{
                $persen_pko[$i] = 0;
            }
        }

        $data['persen_cpo'] = $persen;
        $data['persen_pko'] = $persen_pko;
        return view('backend/beranda/index',$data);
    }
}
