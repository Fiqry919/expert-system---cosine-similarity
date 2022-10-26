@extends('layouts.app')

@section('title', 'Konsultasi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Token ID : ') }}{{session()->token()}}</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    {{-- @include('components.message') --}}

                    {!! Form::open(['route' => 'select.store']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                {!! Form::label('gejala', 'Pilih Gejala-gejala dibawah ini sesuai dengan kondisi yang dialami', ['class' => 'control-label font-weight-bold required']) !!}
                                <br>
                                <table class="table table-striped table-sm">
                                    @foreach ($gejala as $key => $data)
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="gejala" name="gejala[]" value="{{$data->kode}}">
                                            &nbsp;
                                            <label for="#">{{$key+1}}. {{$data->nama_gejala}}</label>
                                            <br>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <div class="form-text text-danger">@error('gejala'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Diagnosa" class="btn px-5 btn-primary">
                    {!! Form::close() !!}
                </div>
                {{-- <div class="card-footer">{{ __('Token ID : ') }}{{$token}}</div> --}}
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
