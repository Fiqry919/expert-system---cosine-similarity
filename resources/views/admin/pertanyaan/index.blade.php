@extends('layouts.app')

@section('title', 'Question')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css">
<style>
    .center {
        text-align: center;
    }
    .sorting, .sorting_asc, .sorting_desc {
        background : none;
    }
    .ui-datatable .ui-sortable-column-icon {
        display: none !important;
    }
    .previous, .next {
        size: 5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Forward Chaining Rules</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    <a href="{{route('question.create')}}" class="btn btn-success btn-sm">Create</a>
                    <br><br>
                    <table class="table table-bordered table-stripped table-sm yajra">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white text-center">No</th>
                                {{-- <th class="bg-primary text-white text-center">Tipe</th> --}}
                                <th class="bg-primary text-white text-center">Aturan</th>
                                {{-- <th class="bg-primary text-white text-center">Pilihan Jawaban</th> --}}
                                <th class="bg-primary text-white text-center">Gejala sebelumnya</th>
                                <th class="bg-primary text-white text-center">Kondisi "Ya"</th>
                                <th class="bg-primary text-white text-center">Kondisi "Tidak"</th>
                                <th class="bg-primary text-white text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="text-muted"><h6>Catatan :</h6></div>
                    <div class="text-danger ml-2">- Aturan ini akan dijadikan pertanyaan kepada pasien pada saat konsultasi</div>
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
<!-- LIBARARY JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- AKHIR LIBARARY JS -->

<script>
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
    // ajax datatable
    $(document).ready(function () {
        dataId = $(this).attr('id');
        var table = $('.yajra').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('question.index') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex', width: "10%", orderable: false, searchable: false,width:20, fixedColumns: true},
                {data: 'no', name: 'no', className: 'center', width: "10%", orderable: false},
                // {data: 'type', name: 'type', className: 'center', width: "10%", orderable: false, defaultContent: "-"},
                {data: 'gejala', name: 'gejala', orderable: false, defaultContent: "-"},
                // {data: 'jawaban', name: 'jawaban', className: 'center', width: "10%", orderable: false, defaultContent: "-"},
                {data: 'parent', name: 'parent', className: 'center', width: "10%", orderable: false, defaultContent: "-"},
                {data: 'ya', name: 'ya', className: 'center', width: "10%", orderable: false, defaultContent: "-"},
                {data: 'tidak', name: 'tidak', className: 'center', width: "10%", orderable: false, defaultContent: "-"},
                {data: 'action', name: 'action', width: "10%", orderable: false, searchable: false, className: 'center'},
            ],
            aoColumnDefs: [
                { bSortable: false, aTargets: [ 0, 1, 2 ] }
            ],
            pagingType: "simple"
        }); // end ajax 
    });
    //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    $(document).on('click', '.delete', function () {
        dataId = $(this).attr('id');
        $('#konfirmasi-modal').modal('show');
    });
    //jika tombol hapus pada modal konfirmasi di klik maka
    $('#tombol-hapus').click(function () {
        $.ajax({
            url: "question/" + dataId, //eksekusi ajax ke url ini
            type: 'delete',
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                    window.location.href = 'question';
                });
            }
        })
    });
</script>
@endsection
@endsection
