<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KadarAirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($kategori)
    {
        $data['kategori'] = DB::table('kategori')
            ->where('kategori_id','=',$kategori)
            ->first();
        $data['kadar_air'] = DB::table('data_kadar')
            ->where('kadar_kategori','=',$kategori)
            ->where('kadar_tipe','=', 'air')
            ->get();
        $data['tipe']='air';
        return view('backend/kadar/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hasil = round(($request->a1-$request->a2)/$request->bs,3);
        DB::table('data_kadar')->insert([
            'kadar_A1' => $request->a1,
            'kadar_A2' => $request->a2,
            'kadar_BS' => $request->bs,
            'kadar_hasil' => $hasil,
            'kadar_tipe' => $request->tipe,
            'kadar_kategori' => $request->kategori
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
