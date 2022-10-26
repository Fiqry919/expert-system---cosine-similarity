@extends('layouts.app')

@section('title', 'Aturan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Kasus</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    <a href="{{route('aturan.create')}}" class="btn btn-success btn-sm">Create</a>
                    <br><br>
                    <table class="table table-bordered table-stripped table-sm">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white text-center">No</th>
                                <th class="bg-primary text-white text-center">Gejala yang di alami</th>
                                <th class="bg-primary text-white text-center">Penyakit</th>
                                <th class="bg-primary text-white text-center">Tanggal</th>
                                <th class="bg-primary text-white text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aturan as $key => $data)
                                <tr>
                                    <td class="text-center" style="vertical-align:middle;width:10%">{{$key + $aturan->firstItem()}}</td>
                                    <td class="" style="vertical-align:middle">{{$data->aturan}}</td>
                                    <td class="text-center" style="vertical-align:middle">{{$data->penyakits->nama_penyakit}}</td>
                                    <td class="text-center" style="vertical-align:middle;width:15%">{{$data->created_at->format('d-m-Y')}}</td>
                                    <td class="text-center" style="vertical-align:middle;width:10%">
                                        <a href="{{route('aturan.edit', $data->id)}}" title="edit" class="edit btn text-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <button type="button" name="delete" id="{{$data->id}}" title="hapus" class="delete btn text-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- lINK PAGINATE --}}
                    <nav class="page navigation">
                        <div class="d-flex">
                            <div>Showing {{($aturan->currentpage()-1)*$aturan->perpage()+1}} to {{$aturan->currentpage()*$aturan->perpage()}}
                                of  {{$aturan->total()}} entries
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $aturan->appends([['data' => 'aturan.case']])->onEachSide(1)->links() !!}
                        </div>
                    </nav>
                </div>

                <div class="card-footer">
                    <div class="text-muted"><h6>Catatan :</h6></div>
                    <ul>
                        <li class="text-danger">Data kasus ini akan menjadi acuan pada saat pasien konsultasi.</li>
                        <div class="text-danger">Dimana ketika pasien tidak menemukan data kasus yang serupa maka sistem akan menentukan berdasarkan tingkat similarity terbesar,-</div>
                        <div class="text-danger">kemudian akan disimpan sebagai kasus baru</div>
                    </ul>
                </div>
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
            url: "aturan/" + dataId, //eksekusi ajax ke url ini
            type: 'delete',
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                    window.location.href = 'aturan';
                });
            }
        })
    });
</script>
@endsection
@endsection