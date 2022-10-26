@extends('layouts.app')

@section('title', 'Tambah Question')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Pertanyaan</div>

                <div class="card-body">
                    @include('components.message')

                    {!! Form::open(['route' => 'question.store']) !!}
                    {!! Form::hidden('no', $kode, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan no urut pertanyaan', 'readonly']) !!}
                    {!! Form::hidden('type', 'choice', ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Pilih Jenis Pertanyaan', 'readonly']) !!}
                    {!! Form::hidden('jawaban', 'Ya,Tidak', ['rows' => 4,'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Pilihan jawaban', 'readonly']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('pertanyaan', 'Pertanyaan Gejala', ['class' => 'control-label required']) !!}
                                <select class="form-control col-sm-12" name="pertanyaan">
                                    <option value="" selected disabled hidden>Pilih Gejala</option>
                                    @foreach ($gejala as $g)
                                        <option value="{{$g->kode}}">{{$g->kode}} - {{$g->nama_gejala}}</option>
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
                                <select class="form-control col-sm-12" name="parent">
                                    <option value="" selected disabled hidden>Pilih Gejala</option>
                                    @foreach ($gejala as $g)
                                        <option value="{{$g->kode}}">{{$g->kode}} - {{$g->nama_gejala}}</option>
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
                                <select class="form-control col-sm-12" name="ya">
                                    <option value="" selected disabled hidden>Pilih Gejala</option>
                                    <option class=" bg-primary text-center text-white" value="" disabled>Gejala</option>
                                    @foreach ($gejala as $g)
                                        <option value="{{$g->kode}}">{{$g->kode}} - {{$g->nama_gejala}}</option>
                                    @endforeach
                                    <option class=" bg-primary text-center text-white" value="" disabled>Penyakit</option>
                                    @foreach ($penyakit as $p)
                                        <option value="{{$p->kode}}">{{$p->kode}} - {{$p->nama_penyakit}}</option>
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
                                <select class="form-control col-sm-12" name="tidak">
                                    <option value="" selected disabled hidden>Pilih Gejala</option>
                                    <option class=" bg-primary text-center text-white" value="" disabled>Gejala</option>
                                    @foreach ($gejala as $g)
                                        <option value="{{$g->kode}}">{{$g->kode}} - {{$g->nama_gejala}}</option>
                                    @endforeach
                                    <option class=" bg-primary text-center text-white" value="" disabled>Penyakit</option>
                                    @foreach ($penyakit as $p)
                                        <option value="{{$p->kode}}">{{$p->kode}} - {{$p->nama_penyakit}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text text-danger">@error('tidak'){{$message}}@enderror</div>
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
