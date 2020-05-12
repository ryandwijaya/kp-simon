@php use Illuminate\Support\Facades\DB;  @endphp
@extends('backend/layout/main')

@section('title_page','Sub Menu')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Data Sub Menu
                    </h4>
                    <button class="btn btn-primary float-right btn-sm"  data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Sub Menu</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <ul>
                                @foreach($kategori as $kt)
                                    @php $sub = DB::table('sub_menu')->where('menu_kategori','=', $kt->kategori_id)->get(); @endphp
                                    <li>{{$kt->kategori_nama}}
                                        <ul>

                                                @foreach($sub as $sb)
                                                <li>
                                                    {{ $sb->menu_sub }}
                                                </li>
                                                @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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
                    <form action="{{ action('SubMenuController@store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <select name="menu_kategori" class="form-control">
                                <option disabled selected>- Pilih Kategori -</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Menu</label>
                            <input type="text" name="menu_sub" required class="form-control" placeholder="Sub menu">
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" name="link" class="form-control" placeholder="Masukkan Link">
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





