@php use Illuminate\Support\Facades\DB;  @endphp
@extends('backend/layout/main')

@section('title_page','Beranda')

@section('konten')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Grafik Tanggal : {{ date_indo($tgl) }}
                    </h4>
                    <form action="{{ url('/beranda') }}" method="post">
                        @csrf
                        <button type="submit" class="float-right">Lihat</button>
                        <input type="date" name="tgl" class="float-right">
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <canvas id="cpo" height="200"></canvas>
                        </div>
                        <div class="col-6">
                            <canvas id="pko" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    var config = {
        type: 'line',
        data: {
            labels: [<?php
                foreach($cpo as $i => $item){
                    echo '"'.$item->menu_sub.'"';
                    if ($i<count($cpo)-1) {
                        echo ",";
                    }else{
                        echo " ";
                    }
                }
                ?>],
            datasets: [{
                borderColor:'blue',
                backgroundColor: 'blue',
                fill: false,
                label: 'Norma',
                data: [<?php
                    foreach($cpo as $i => $item){
                        echo $item->menu_norma;
                        if ($i<count($cpo)-1) {
                            echo ",";
                        }else{
                            echo " ";
                        }
                    }
                    ?>],
            }, {
                borderColor:'green',
                backgroundColor: 'green',
                fill: false,
                label: 'Data',
                data: [<?php
                    for($i=0;$i<count($persen_cpo);$i++){
                        echo $persen_cpo[$i];
                        if ($i<count($persen_cpo)-1) {
                            echo ",";
                        }else{
                            echo " ";
                        }
                    }
                    ?>],
            }]
        },
        options: {
            spanGaps: true,
            responsive: true,
            title: {
                display: true,
                text: 'Grafik CPO'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Labels'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Values'
                    },

                }]
            }
        }
    };

    var config2 = {
        type: 'line',
        data: {
            labels: [<?php
                foreach($pko as $a => $p){
                    echo '"'.$p->menu_sub.'"';
                    if ($a<count($pko)-1) {
                        echo ",";
                    }else{
                        echo " ";
                    }
                }
                ?>],
            datasets: [{
                borderColor:'blue',
                backgroundColor: 'blue',
                fill: false,
                label: 'Norma',
                data: [<?php
                    foreach($pko as $a => $p){
                        echo $p->menu_norma;
                        if ($a<count($pko)-1) {
                            echo ",";
                        }else{
                            echo " ";
                        }
                    }
                    ?>],
            }, {
                borderColor:'green',
                backgroundColor: 'green',
                fill: false,
                label: 'Data',
                data: [<?php
                    for($i=0;$i<count($persen_pko);$i++){
                        echo $persen_pko[$i];
                        if ($i<count($persen_pko)-1) {
                            echo ",";
                        }else{
                            echo " ";
                        }
                    }
                    ?>],
            }]
        },
        options: {
            spanGaps: true,
            responsive: true,
            title: {
                display: true,
                text: 'Grafik PKO'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Labels'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Values'
                    },

                }]
            }
        }
    };

    window.onload = function() {
        var ctn = document.getElementById('cpo').getContext('2d');
        window.myLine = new Chart(ctn, config);
        var ctx = document.getElementById('pko').getContext('2d');
        window.myGraph = new Chart(ctx, config2);
    };
</script>
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
