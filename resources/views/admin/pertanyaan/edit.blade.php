@extends('layouts.app')

@section('title', 'Edit Question')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Pertanyaan</div>

                <div class="card-body">
                    @include('components.message')

                    {!! Form::model($pertanyaan, array('url' => "question/$pertanyaan->id", 'method' => 'put')) !!}
                    {!! Form::hidden('no', null, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan no urut pertanyaan', 'readonly']) !!}
                    {!! Form::hidden('type', 'choice', ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Pilih Jenis Pertanyaan', 'readonly']) !!}
                    {!! Form::hidden('jawaban', 'Ya,Tidak', ['rows' => 4,'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Pilihan jawaban', 'readonly']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('pertanyaan', 'Pertanyaan Gejala', ['class' => 'control-label required']) !!}
                                <select class="form-control col-sm-12" name="pertanyaan" id="pertanyaan">
                                    <option value="" selected disabled hidden>Pilih Gejala</option>
                                    @foreach ($gejala as $key => $g)
                                        <option value="{{$key}}" @if ($pertanyaan->pertanyaan == $key) selected @endif>{{$key}} - {{$g}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text text-danger">@error('pertanyaan'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('parent', 'Gejala Sebelumnya', ['class' => 'control-label']) !!}
                                <select class="form-control col-sm-12" name="parent" id="parent">
                                    <option value="">Pilih Gejala</option>
                                    @foreach ($gejala as $key => $g)
                                        <option value="{{$key}}" @if ($pertanyaan->parent == $key) selected @endif>{{$key}} - {{$g}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text text-danger">@error('parent'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('ya', 'Kondisi / Gejala Ya', ['class' => 'control-label required']) !!}
                                <select class="form-control col-sm-12" name="ya" id="ya">
                                    <option selected value="" selected disabled hidden>Pilih Gejala</option>
                                    <option class=" bg-primary text-center text-white" value="" disabled>Gejala</option>
                                    @foreach ($gejala as $key => $g)
                                        <option value="{{$key}}" @if ($pertanyaan->ya == $key) selected @endif>{{$key}} - {{$g}}</option>
                                    @endforeach
                                    <option class=" bg-primary text-center text-white" value="" disabled>Penyakit</option>
                                    @foreach ($penyakit as $key => $p)
                                        <option value="{{$key}}" @if ($pertanyaan->ya == $key) selected @endif>{{$key}} - {{$p}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text text-danger">@error('ya'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('tidak', 'Kondisi / Gejala tidak', ['class' => 'control-label required']) !!}
                                <select class="form-control col-sm-12" name="tidak" id="tidak">
                                    <option value="" selected disabled hidden>Pilih Gejala</option>
                                    <option class=" bg-primary text-center text-white" value="" disabled>Gejala</option>
                                    @foreach ($gejala as $key => $g)
                                        <option value="{{$key}}" @if ($pertanyaan->tidak == $key) selected @endif>{{$key}} - {{$g}}</option>
                                    @endforeach
                                    <option class=" bg-primary text-center text-white" value="" disabled>Penyakit</option>
                                    @foreach ($penyakit as $key => $p)
                                        <option value="{{$key}}" @if ($pertanyaan->tidak == $key) selected @endif>{{$key}} - {{$p}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text text-danger">@error('tidak'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Update" class="btn px-5 btn-primary">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
