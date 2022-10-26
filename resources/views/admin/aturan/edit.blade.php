@extends('layouts.app')

@section('title', 'Edit Aturan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit</div>

                <div class="card-body">
                    @include('components.message')

                    {!! Form::model($aturan, array('url' => "aturan/$aturan->id", 'method' => 'put')) !!}
                    <div class="row">
                        <div class="col-md-0">
                            <div class="form-group first">
                                {{-- {!! Form::label('kode', 'Kode', ['class' => 'control-label required']) !!} --}}
                                {!! Form::hidden('kode', null, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan kode Aturan', 'readonly']) !!}
                                <div class="form-text text-danger">@error('kode'){{$message}}@enderror</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group first">
                                {!! Form::label('penyakit', 'Penyakit', ['class' => 'control-label required']) !!}
                                {!! Form::select('penyakit', $penyakit, null, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Pilih penyakit']) !!}
                                <div class="form-text text-danger">@error('penyakit'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('aturan', 'Pilih Gejala', ['class' => 'control-label required']) !!}
                                <br>
                                @for ($i = 0; $i < count($gejala); $i++)
                                    <input type="checkbox" id="{{'aturan_' . $i}}" name="{{'aturan_' . $i}}" value="{{$kode[$i]}}"
                                        @for ($x = 0; $x < count($data); $x++)
                                        @if($data[$x] == $kode[$i]) checked @endif
                                        @endfor>

                                    &nbsp;
                                    <label for="{{'aturan_' . $i}}">{{$i+1}}. {{$gejala[$i]->nama_gejala}}</label>
                                    <br>
                                @endfor
                                <div class="form-text text-danger">@error('kode'){{$message}}@enderror</div>
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