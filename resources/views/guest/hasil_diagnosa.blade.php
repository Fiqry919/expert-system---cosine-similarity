@extends('layouts.app')

@section('title', 'Hasil Diagnosa')

@section('css')
    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    {{-- loader --}}
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group first">
                                <div class="text text-small">Token ID : {{session()->token()}}</div>
                                <br>
                                <table class="table table-bordered table-stripped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary text-center text-white text-light" colspan="6">Hasil Diagnosa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="text-center text-small" style="vertical-align:middle">Nama</td>
                                            <td colspan="2" class="text-small" style="vertical-align:middle">{{session('name')}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center text-small" style="vertical-align:middle">Email</td>
                                            <td colspan="2" class="text-small" style="vertical-align:middle">{{session('email')}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" rowspan="{{count($gejala)}}" class="text-center text-small" style="vertical-align:middle">Gejala</td>
                                        @foreach ($gejala as $key => $value)
                                            <td>
                                                <div class="col md-2">
                                                    {{$key+1}}. {{$value->nama_gejala}}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-center" style="vertical-align:middle">Penyakit</td>
                                            @if (!empty($penyakit))
                                            <td colspan="2" class="text-center bg-primary text-white" style="vertical-align:middle">{{$penyakit->nama_penyakit}}</td>
                                            @else
                                            {{-- Penyakit with rumus here --}}
                                            <td colspan="2" class="text-center bg-primary text-white" style="vertical-align:middle">-</td>
                                            @endif
                                        </tr>
                                        @if (!empty($solusi))
                                            <tr>
                                                <td colspan="2" rowspan="{{count($solusi)}}" class="text-center" style="vertical-align:middle">Solusi</td>
                                            @foreach ($solusi as $key1 => $value1)
                                                @if (count($solusi) > 1)
                                                <td class="bg-primary text-white" style="vertical-align:middle">
                                                    <div class="col ml-2">
                                                        {{$key1+1}}. {{$value1}}
                                                    </div>
                                                </td>
                                                @else
                                                <td class="text-center bg-primary text-white" style="vertical-align:middle">{{$value1}}</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        @else
                                            {{-- Solusi with Rumus Here --}}
                                            <tr>
                                                <td colspan="2" rowspan="1" class="text-center" style="vertical-align:middle">Solusi</td>
                                                <td class="text-center bg-primary text-white" style="vertical-align:middle">-</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col text-center">
                        <a class="btn px-5 btn-danger" href="{{route('done')}}" role="button">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <!-- Loader js -->
    <script>
        $(document).ready(function(){
            $(".is-active").fadeOut(1500);
        })
    </script>
@endsection

@endsection
