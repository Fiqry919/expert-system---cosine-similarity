@extends('layouts.app')

@section('title', 'Konsultasi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Form Pendaftaran') }}</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    {!! Form::open(['route' => 'konsultasi.store']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('name', 'Nama', ['class' => 'control-label required']) !!}
                                {!! Form::text('name', null, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Nama']) !!}
                                <div class="form-text text-danger">@error('name'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('email', 'Email', ['class' => 'control-label required']) !!}
                                {!! Form::email('email', null, ['autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Masukan Email']) !!}
                                <div class="form-text text-danger">@error('email'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-3">
                        <div class="ml-auto mr-sm-5">
                            <input type="submit" value="Next" class="btn px-5 btn-primary">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
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
