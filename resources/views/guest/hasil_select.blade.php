@extends('layouts.app')

@section('title', 'Hasil Diagnosa')

@section('css')
    <style>
        .bg-orange {
            background-color:rgba(255, 140, 0, 0.918);
        }
    </style>
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
                                            <td colspan="2" rowspan="{{count($data)}}" class="text-center text-small" style="vertical-align:middle">Gejala</td>
                                        @foreach ($data as $key => $value)
                                            <td colspan="4">
                                                <div class="col md-2">
                                                    {{$key+1}}. {{$value}}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if (!empty($penyakit))
                                            {{-- Reuse old case --}}
                                            <tr>
                                                <td colspan="2" rowspan="2" class="text-center" style="vertical-align:middle">Penyakit</td>
                                                <td colspan="4" class="text-center bg-success text-white" style="vertical-align:middle">Reuse</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-center bg-primary text-white" style="vertical-align:middle">{{$penyakit->nama_penyakit}}</td>
                                            </tr>
                                        @else
                                            {{-- new case / found similarity --}}
                                            <tr>
                                                <td colspan="2" rowspan="{{count($penyakits) + 1}}" class="text-center" style="vertical-align:middle">Penyakit</td>
                                                <td colspan="4" class="text-center bg-orange text-white" style="vertical-align:middle">Similarity</td>
                                            </tr>
                                            <tr>
                                                @foreach ($penyakits as $key => $item)
                                                <td colspan="2" class="text-center bg-primary text-white" style="vertical-align:middle">
                                                    <div class="col md-2">
                                                        {{$item->nama_penyakit}}
                                                    </div>
                                                </td>
                                                <td colspan="2" class="text-center bg-primary text-white" style="vertical-align:middle">
                                                    <div class="col md-2">
                                                        {{$percentase[$key]}} %
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        @if (!empty($solusi))
                                            {{-- Reuse Solusi --}}
                                            <tr>
                                                <td colspan="2" rowspan="{{count($solusi)}}" class="text-center" style="vertical-align:middle">Solusi</td>
                                            @foreach ($solusi as $key1 => $value1)
                                                @if (count($solusi) > 1)
                                                <td colspan="4" class="bg-primary text-white text-center" style="vertical-align:middle">
                                                    <div class="col ml-2">
                                                        {{$value1}}
                                                    </div>
                                                </td>
                                                @else
                                                <td colspan="4" class="text-center bg-primary text-white" style="vertical-align:middle">{{$value1}}</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        @else
                                            {{-- Solusi similarity --}}
                                            <tr>
                                                <td colspan="2" rowspan="1" class="text-center" style="vertical-align:middle">Solusi</td>
                                                <td colspan="4" class="text-center bg-primary text-white" style="vertical-align:middle">-</td>
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
