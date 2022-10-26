@extends('layouts.app')

@section('title', 'Lihat Hasil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('') }}</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th class="bg-primary text-center text-light" colspan="6">Hasil Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center text-small" style="vertical-align: middle">Nama</td>
                                <td colspan="2" class="col ml-2 text-small" style="vertical-align: middle">{{$history->name}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center text-small" style="vertical-align: middle">Email</td>
                                <td colspan="2" class="col ml-2 text-small" style="vertical-align: middle">{{$history->email}}</td>
                            </tr>
                            <tr>
                                @if (count($gejala) > 0)
                                        <td colspan="2" rowspan="{{count($gejala)}}" class="text-center text-small" style="vertical-align:middle">Gejala</td>
                                    @foreach ($gejala as $key => $value)
                                        <td>
                                            <div class="col md-2">
                                                {{$key+1}}. {{$value->gejala}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <td colspan="2" rowspan="1" class="text-center text-small" style="vertical-align:middle">Gejala</td>
                                    <td colspan="2" rowspan="1" class="text-center text-small" style="vertical-align:middle">Unknow</td>
                                @endif
                            <tr>
                                <td colspan="2" class="text-center" style="vertical-align: middle">Penyakit</td>
                                <td colspan="2" class="bg-primary text-white text-center" style="vertical-align: middle">{{$history->penyakit}}</td>
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
                                <tr>
                                    <td colspan="2" rowspan="1" class="text-center" style="vertical-align:middle">Solusi</td>
                                    <td class="text-center bg-primary text-white" style="vertical-align:middle">Unknow</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <br>
                    <div class="col ml-auto">
                        <a class="btn px-5 btn-danger" href="{{ url()->previous() }}" role="button">&laquo; Back</a>
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
            $(".is-active").fadeOut(500);
        })
    </script>
@endsection

@endsection
