@extends('backend/layout/main')

@section('title_page','ALB')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Data ALB ( {{ $kategori->kategori_nama }} )
                    </h4>
                    <button class="btn btn-primary float-right btn-sm"  data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Data ALB</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example2" style="width:100%;font-size: 14px;">
                            <thead class="bg-light">
                            <tr class="text-center">
                                <th class="text-center" width="50">No</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>Hasil</th>
                                <th>Waktu</th>
                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alb as $item)
                                <tr class="text-center">
                                    <td >{{ $loop->iteration }}</td>
                                    <td>{{ $item->alb_A }}</td>
                                    <td>{{ $item->alb_B }}</td>
                                    <td>{{ $item->alb_C }}</td>
                                    <td>{{ $item->alb_D }}</td>
                                    <td>{{ $item->alb_hasil }}%</td>
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
                    <form action="{{ url('alb/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kategori" value="{{ Request::segment(2) }}">
                        <div class="form-group">
                            <label>A</label>
                            <input type="text" name="a" placeholder="Masukkan jumlah A" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>B</label>
                            <input type="text" name="b" placeholder="Masukkan jumlah B" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>C</label>
                            <input type="text" name="c" placeholder="Masukkan jumlah C" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>D</label>
                            <input type="text" name="d" placeholder="Masukkan jumlah D" class="form-control" required>
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





