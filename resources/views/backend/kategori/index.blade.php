@extends('backend/layout/main')

@section('title_page','Kategori')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Data Kategori
                    </h4>
                    <button class="btn btn-primary float-right btn-sm"  data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Data Kategori</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="example2" style="width:100%;font-size: 14px;">
                            <thead>
                            <tr>
                                <th class="text-center" width="50">No</th>
                                <th>Nama Kategori</th>
                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->kategori_nama }}</td>
                                        <td class="text-center">E | H</td>
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
                    <form action="{{ action('KategoriController@store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="kategori_nama" placeholder="Masukkan nama kategori" class="form-control" required>
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





