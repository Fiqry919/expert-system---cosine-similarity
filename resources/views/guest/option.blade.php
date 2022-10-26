@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('') }}</div>

                <div class="card-body">
                    <div class="loader loader-default is-active" data-text="Loading"></div>
                    @include('components.message')

                    <div class="container mt-sm-5 my-1">
                        <div class="question pt-2">
                            <div class="py-2 text-center"><b>Pilih salah satu metode dibawah ini</b></div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center pt-4">
                            <div class="mr-sm-5" id="select"> <a href="{{route('guest.index')}}" class="btn btn-outline-primary btn-md">Forward Chaining</a> </div>
                            <div class="mr-sm-5" id="question"> <a href="{{route('select.index')}}" class="btn btn-outline-primary btn-md">Similarity</a> </div>
                            <div class="mr-sm-5" id="question"> <a href="#" class="btn btn-outline-primary btn-md disabled">Coming Soon</a> </div>
                        </div>
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
