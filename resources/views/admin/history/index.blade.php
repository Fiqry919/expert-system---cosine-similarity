@extends('layouts.app')

@section('title', 'Hisotry')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Data Hisotry') }}</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    <table class="table table-bordered table-stripped table-sm">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white text-center" style="vertical-align:middle;">No</th>
                                <th class="bg-primary text-white text-center" style="vertical-align:middle;">Nama</th>
                                <th class="bg-primary text-white text-center" style="vertical-align:middle;">Email</th>
                                <th class="bg-primary text-white text-center" style="vertical-align:middle;">Penyakit</th>
                                <th class="bg-primary text-white text-center" style="vertical-align:middle;">Tanggal Konsultasi</th>
                                <th class="bg-primary text-white text-center" style="vertical-align:middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $key => $data)
                                <tr>
                                    <td class="text-center" style="vertical-align:middle;width:5%">{{$key + $history->firstItem()}}</td>
                                    <td class="" style="vertical-align:middle;width:25%">{{$data->name}}</td>
                                    <td class="" style="vertical-align:middle;width:25%">{{$data->email}}</td>
                                    <td class="text-center" style="vertical-align:middle;width:20%">{{$data->penyakit}}</td>
                                    <td class="text-center" style="vertical-align:middle;width:15%">{{$data->created_at->format('d-m-Y')}}</td>
                                    <td class="text-center" style="vertical-align:middle;width:10%">
                                        <a href="{{route('history.show', $data->id)}}" title="lihat hasil diagnosa" class="edit btn text-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="button" name="delete" id="{{$data->id}}" title="hapus" class="delete btn text-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- lINK PAGINATE --}}
                    <nav class="page navigation">
                        <div class="d-flex">
                            <div>Showing {{($history->currentpage()-1)*$history->perpage()+1}} to {{$history->currentpage()*$history->perpage()}}
                                of  {{$history->total()}} entries
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $history->appends([['data' => 'history.diagnosa']])->onEachSide(1)->links() !!}
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL KONFIRMASI DELETE-->
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
    // loader
    $(document).ready(function(){
        $(".is-active").fadeOut(500);
    })
    // CSRF
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
            url: "history/" + dataId, //eksekusi ajax ke url ini
            type: 'delete',
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                    window.location.href = 'history';
                });
            }
        })
    });
</script>
@endsection

@endsection
{{-- Old link paginate --}}
{{-- <div class="d-flex align-items-center pt-3">
    <div class="button-group">
        @if (!empty($history->previousPageUrl()))
        <div class="mr-auto ml-sm-5" id="prev"> <a href="{{$history->previousPageUrl()}}" class="btn btn-sm btn-outline-danger">&laquo; Previous</a> </div>
        @endif
        @if (!empty($history->nextPageUrl()))
        <div class="ml-auto mr-sm-5" id="prev"> <a href="{{$history->nextPageUrl()}}" class="btn btn-sm btn-outline-primary">Next &raquo;</a> </div>
        @endif
    </div>
</div> --}}

{{-- <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        @if (!empty($history->previousPageUrl()))
        <li class="page-item"><a class="page-link" href="{{$history->previousPageUrl()}}">Previous</a></li>
        @else
        <li class="page-item disabled"><a class="page-link" href="{{$history->previousPageUrl()}}">Previous</a></li>
        @endif
        @if (!empty($history->nextPageUrl()))
        <li class="page-item"><a class="page-link" href="{{$history->nextPageUrl()}}">Next</a></li>
        @else
        <li class="page-item disabled"><a class="page-link" href="{{$history->nextPageUrl()}}">Next</a></li>
        @endif
    </ul>
</nav> --}}
