@extends('layouts.app')

@section('title', 'Question')

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
        .question {
            width: 75%
        }
        .options {
            position: relative;
            padding-left: 40px
        }
        #options label {
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
            cursor: pointer
        }
        .options input {
            opacity: 0
        }
        .checkmark {
            position: absolute;
            top: -1px;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: rgb(255, 255, 255);
            border: 1px solid #ddd;
            border-radius: 50%
        }
        .options input:checked~.checkmark:after {
            display: block
        }
        .options .checkmark:after {
            content: "";
            width: 10px;
            height: 10px;
            display: block;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 300ms ease-in-out 0s
        }
        .options input[type="radio"]:checked~.checkmark {
            background: #0090e0;
            transition: 300ms ease-in-out 0s
        }
        .options input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1)
        }

        .btn-prev {
            background-color: #555;
            color: rgb(255, 255, 255);
            border: 1px solid #ddd
        }
        .btn-prev:hover {
            background-color: rgb(75, 75, 75);
            border: 1px solid #555;
            color: #ddd;
        }

        .btn-suces {
            padding: 5px 25px;
            background-color: #0090e0;
            border: 1px solid #ddd;
            color: rgb(255, 255, 255);
        }
        .btn-suces:hover {
            background-color: #007fc4;
            border: 1px solid #0090e0;
            color: #ddd;
        }

        .btn-submit {
            padding: 5px 25px;
            background-color: #21bf73;
            border: 1px solid #ddd;
            color: rgb(255, 255, 255);
        }
        .btn-submit:hover {
            padding: 5px 25px;
            background-color: #1da764;
            border: 1px solid #21bf73;
            color: #ddd;
        }

        @media(max-width:576px) {
            .question {
                width: 100%;
                word-spacing: 2px
            }
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Token ID : ') }}{{$token}}</div>
                
                <div class="container mt-sm-5 my-1">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    {!! Form::open(['route' => 'guest.store']) !!}
                    @foreach ($pertanyaan as $key => $item)
                    <div class="question ml-sm-5 pl-sm-5 pt-2">
                        {{-- PAGE --}}
                        {!! Form::hidden('page', $page, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Jawaban', 'readonly']) !!}
                        <div class="form-text text-danger">@error('page'){{$message}}@enderror</div>
                            {{-- PERTANYAAN --}}
                            <div class="py-2 h5"><b>{{$item->nama_gejala}} ?</b></div>
                            {{-- PILIHAN JAWABAN --}}
                            <div class="ml-md-3 ml-sm-3 pl-md-0 pt-sm-0 pt-3" id="options">
                                @foreach ($select as $key1 => $selection)
                                    <label class="options">{{$selection}}
                                        <input type="radio" name="jawaban" value="{{$selection}}" @if ($selection == session()->get('jawaban'.$page)) checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                                <div class="form-text text-danger">@error('jawaban')Pilih salah satu jawaban @enderror</div>
                            </div>
                    </div>
                    <div class="d-flex align-items-center pt-3">
                        @if (!empty($pertanyaan->previousPageUrl()))
                        <div class="ml-sm-5 mr-auto" id="prev"> <a href="{{$pertanyaan->previousPageUrl()}}" class="btn btn-prev">&laquo; Previous</a> </div>
                        @endif
                        <div class="ml-auto mr-sm-5"> <input type="submit" value="Next &raquo;" class="btn btn-suces"> </div>
                    @endforeach
                    {!! Form::close() !!}
                </div>
                <br>

            </div>
        </div>
    </div>
</div>

@section('js')
    <!-- Loader js -->
    <script>
        $(document).ready(function(){
            $(".is-active").fadeOut(500);
        })
    </script>
@endsection

@endsection

{{-- ini untuk pilihan jawaban sesuai database --}}
{{-- @if (!empty($item->pertanyaan))
    <div class="py-2 h5"><b>{{$gejala->nama_gejala}} ?</b></div>
    <div class="ml-md-3 ml-sm-3 pl-md-0 pt-sm-0 pt-3" id="options">
        @if ($item->type == 'choice')
            @foreach ($jawaban[$item->no] as $data)    
                <label class="options">{{$data}}
                    <input type="radio" name="jawaban" value="{{$data}}" @if ($data == session()->get('jawaban'.$page)) checked @endif>
                    <span class="checkmark"></span>
                </label>
            @endforeach
        @endif
        @if ($item->type == 'select')
            <label class="control-label">
                {!! Form::select('jawaban', $jawaban[$item->no], null, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Pilih Jawaban']) !!}
            </label>
        @endif
        @if ($item->type == 'number') 
            <label class="control-label">
                <input autocomplete="off" type="number" name="jawaban" class="form-control" placeholder="Masukan Jawaban">
            </label>
        @endif
        @if ($item->type == 'text') 
            <label class="control-label">
                {!! Form::textarea('jawaban', null, ['rows' => 4,'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Jawaban']) !!}
            </label>
        @endif
        <div class="form-text text-danger">@error('jawaban') Pilih salah satu jawaban @enderror</div>
    </div>
@else
    move another question here
@endif --}}