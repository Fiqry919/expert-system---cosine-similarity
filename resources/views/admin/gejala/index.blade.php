@extends('layouts.app')

@section('title', 'Gejala')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Gejala</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    <a href="{{route('gejala.create')}}" class="btn btn-success btn-sm">Create</a>
                    <br><br>
                    <table class="table table-bordered table-stripped table-sm">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white text-center">Kode</th>
                                <th class="bg-primary text-white text-center">Gejala</th>
                                <th class="bg-primary text-white text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gejala as $data)
                                <tr>
                                    <td class="text-center" style="vertical-align:middle">{{$data->kode}}</td>
                                    <td style="vertical-align:middle">{{$data->nama_gejala}}</td>
                                    <td class="text-center" style="vertical-align:middle" style="width: 10%">
                                        <a href="{{route('gejala.edit', $data->id)}}" title="edit" class="edit btn text-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <button type="button" name="delete" id="{{$data->id}}" title="hapus" class="delete btn text-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
<!-- MULAI MODAL KONFIRMASI DELETE-->
<div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Menghapus data</b></p>
                <p>*apakah anda yakin?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-primary" data-dismiss="modal" title="close">Batal</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus" title="hapus"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR MODAL -->
@section('js')
<script type="text/javascript">
    // Loader js
    $(document).ready(function(){
        $(".is-active").fadeOut(500);
    })
    
    // datatable
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    $(document).on('click', '.delete', function () {
        dataId = $(this).attr('id');
        $('#konfirmasi-modal').modal('show');
    });
    //jika tombol hapus pada modal konfirmasi di klik maka
    $('#tombol-hapus').click(function () {
        $.ajax({
            url: "gejala/" + dataId, //eksekusi ajax ke url ini
            type: 'delete',
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                    window.location.href = 'gejala';
                });
            }
        })
    });
</script>
@endsection
@endsection