@extends('backend/layout/main')

@section('title_page','ALB')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Data Kadar {{ $tipe }} ( {{ $kategori->kategori_nama }} )
                    </h4>
                    <button class="btn btn-primary float-right btn-sm"  data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Data Kadar {{ $tipe }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example2" style="width:100%;font-size: 14px;">
                            <thead class="bg-light">
                            <tr class="text-center">
                                <th class="text-center" width="50">No</th>
                                <th>A1</th>
                                <th>A2</th>
                                <th>BS</th>
                                <th>Hasil</th>
                                <th>Waktu</th>
                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kadar_air as $item)
                                <tr class="text-center">
                                    <td >{{ $loop->iteration }}</td>
                                    <td>{{ $item->kadar_A1 }}</td>
                                    <td>{{ $item->kadar_A2 }}</td>
                                    <td>{{ $item->kadar_BS }}</td>
                                    <td>{{ $item->kadar_hasil }}%</td>
                                    <td>{{ $item->date_created }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning">edit</button>
                                        <button class="btn btn-sm btn-danger">hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('ka/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kategori" value="{{ Request::segment(2) }}">
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <div class="form-group">
                            <label>A1</label>
                            <input type="text" name="a1" placeholder="Masukkan jumlah A1" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>A2</label>
                            <input type="text" name="a2" placeholder="Masukkan jumlah A2" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>BS</label>
                            <input type="text" name="bs" placeholder="Masukkan jumlah BS" class="form-control" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection





