<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbController extends Controller
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
        $data['alb'] = DB::table('data_alb')
            ->where('alb_kategori','=',$kategori)
            ->get();
        return view('backend/alb/index',$data);
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
        $hasil = round(($request->a*$request->b*$request->c)/$request->d,3);
        DB::table('data_alb')->insert([
            'alb_A' => $request->a,
            'alb_B' => $request->b,
            'alb_C' => $request->c,
            'alb_D' => $request->d,
            'alb_hasil' => $hasil,
            'alb_kategori' => $request->kategori
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
