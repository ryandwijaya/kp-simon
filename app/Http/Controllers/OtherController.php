<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($tipe,$kategori)
    {
        $data['kategori'] = DB::table('kategori')
            ->where('kategori_id','=',$kategori)
            ->first();
        $data['others'] = DB::table('data_other')
            ->where('other_kategori','=',$kategori)
            ->where('other_tipe','=',$tipe)
            ->get();
        $data['tipe']= $tipe;
        return view('backend/others/index',$data);

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
        $hasil = round($request->h1/$request->h2,3);
        DB::table('data_other')->insert([
            'other_H1' => $request->h1,
            'other_H2' => $request->h2,
            'other_hasil' => $hasil,
            'other_tipe' => $request->tipe,
            'other_kategori' => $request->kategori
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
