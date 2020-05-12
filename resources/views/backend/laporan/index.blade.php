@php use Illuminate\Support\Facades\DB;@endphp
@extends('backend/layout/main')

@section('title_page','Laporan')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-print-none">
                    <h4 class="card-title float-left">
                        Laporan Harian
                    </h4>
                    <buton onclick="window.print()" class="btn btn-info btn-sm float-left ml-4"><i class="fa fa-print"></i> Print Laporan</buton>
                    <form action="{{ url('/laporan') }}" method="post">
                        @csrf
                    <button type="submit" class="float-right">Lihat</button>
                    <input type="date" name="tgl" class="float-right">
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4 class="text-uppercase">Laporan Harian Data Hasil Analisa CPO dan PKO </h4>
                        </div>
                    </div>
                    <div class="row  mt-4">
                        <div class="col-4">
                            <h6>Tanggal : {{ date_indo($tgl) }}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                                <table class="table table-bordered table-hover" style="width:100%;font-size: 14px;">
                                    <thead class="bg-light">
                                    <tr>
                                        <th width="370px"> Kategori </th>
                                        <th class="text-center">Norma</th>
                                        <th class="text-center">Rata-Rata</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kategori as $item)
                                            @php

                                            @endphp
                                            <tr>
                                                <td><b>{{ $item->kategori_nama }}</b></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @php
                                                $sub_menu = DB::table('sub_menu')->where('menu_kategori','=',$item->kategori_id)->get();
                                            @endphp
                                            @foreach($sub_menu as $sub)
                                                <tr>
                                                    <td> -  {{$sub->menu_sub}}</td>
                                                    <td class="text-right">< {{$sub->menu_norma}}</td>
                                                    <td class="text-right">
                                                        @if($sub->menu_table == 'data_alb')
                                                            @php
                                                            $panjang = DB::table('data_alb')->whereDate('date_created',$tgl)->count();
                                                            if($panjang>0){
                                                            $hasil = DB::table('data_alb')->whereDate('date_created',$tgl)->get()->sum('alb_hasil');
                                                            $persen = round($hasil/$panjang,3).'%';
                                                            if ($persen > $sub->menu_norma){
                                                                    echo '<span class="text-danger">'.$persen.'</span>';
                                                                }else{
                                                                    echo $persen;
                                                                }
                                                            }
                                                            @endphp

                                                        @elseif($sub->menu_table == 'data_kadar')
                                                            @php
                                                                $panjang = DB::table('data_kadar')->where('kadar_kategori',$item->kategori_id)->where('kadar_tipe',$sub->menu_table_tipe)->whereDate('date_created',$tgl)->count();
                                                                if($panjang>0){
                                                                $hasil = DB::table('data_kadar')->where('kadar_kategori',$item->kategori_id)->where('kadar_tipe',$sub->menu_table_tipe)->whereDate('date_created',$tgl)->get()->sum('kadar_hasil');
                                                                $persen= round($hasil/$panjang,3).'%';
                                                                if ($persen > $sub->menu_norma){
                                                                    echo '<span class="text-danger">'.$persen.'</span>';
                                                                }else{
                                                                    echo $persen;
                                                                }
                                                                }
                                                            @endphp
                                                        @elseif($sub->menu_table == 'data_other')
                                                            @php
                                                                $panjang = DB::table('data_other')->where('other_kategori',$item->kategori_id)->where('other_tipe',$sub->menu_table_tipe)->whereDate('date_created',$tgl)->count();
                                                                if($panjang>0){
                                                                $hasil = DB::table('data_other')->where('other_kategori',$item->kategori_id)->where('other_tipe',$sub->menu_table_tipe)->whereDate('date_created',$tgl)->get()->sum('other_hasil');
                                                                $persen = round($hasil/$panjang,3).'%';
                                                                if ($persen > $sub->menu_norma){
                                                                    echo '<span class="text-danger">'.$persen.'</span>';
                                                                }else{
                                                                    echo $persen;
                                                                }
                                                                }else{
                                                                $hasil =0;
                                                                }


                                                            @endphp

                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@php
    function date_indo($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun;
    }

    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
@endphp




