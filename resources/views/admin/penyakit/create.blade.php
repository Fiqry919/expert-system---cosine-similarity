@extends('layouts.app')

@section('title', 'Tambah Penyakit')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Tambah Penyakit</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['route' => "penyakit.store"]) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group first">
                                {!! Form::label('kode', 'Kode', ['class' => 'control-label required']) !!}
                                {!! Form::text('kode', $kode, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan kode penyakit', 'readonly']) !!}
                                <div class="form-text text-danger">@error('kode'){{$message}}@enderror</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group first">
                                {!! Form::label('nama_penyakit', 'Nama Penyakit', ['class' => 'control-label required']) !!}
                                {!! Form::text('nama_penyakit', null, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Nama penyakit']) !!}
                                <div class="form-text text-danger">@error('nama_penyakit'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('solusi', 'Solusi', ['class' => 'control-label required']) !!}
                                {!! Form::textarea('solusi', null, ['rows' => 4,'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Solusi Penyembuhan']) !!}
                                <div class="form-text text-danger">@error('solusi'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <input type="submit", value="Save", class="btn px-5 btn-primary">
                    {!! Form::close() !!}
                </div>
                <div class="card-footer">
                    <div class="text-muted">Catatan :</div>
                    <div class="text-danger ml-2">- Jika memiliki beberapa solusi, gunakan tanda koma (,) sebagai pemisah</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection