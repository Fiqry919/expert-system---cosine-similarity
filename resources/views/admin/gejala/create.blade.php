@extends('layouts.app')

@section('title', 'Tambah Gejala')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Tambah Gejala</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['route' => "gejala.store"]) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group first">
                                {!! Form::label('kode', 'Kode', ['class' => 'control-label required']) !!}
                                {!! Form::text('kode', $kode, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan kode gejala', 'readonly']) !!}
                                <div class="form-text text-danger">@error('kode'){{$message}}@enderror</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('nama_gejala', 'Gejala', ['class' => 'control-label required']) !!}
                                {!! Form::textarea('nama_gejala', null, ['rows' => 2,'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Gejala']) !!}
                                <div class="form-text text-danger">@error('nama_gejala'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Save" class="btn px-5 btn-primary">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection