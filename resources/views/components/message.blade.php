{{-- CRUD Message --}}
@if (session('created'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('created')}}</div>
    </div>
@endif
@if (session('update'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('update')}}</div>
    </div>
@endif
@if (session('delete'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('delete')}}</div>
    </div>
@endif

{{-- Notif Message --}}

{{-- green --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('success')}}</div>
    </div>
@endif
{{-- blue --}}
@if (session('message'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('message')}}</div>
    </div>
@endif
{{-- yellow --}}
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('warning')}}</div>
    </div>
@endif
{{-- red --}}
@if (session('danger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('danger')}}</div>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('error')}}</div>
    </div>
@endif
@if (session('alert'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>{{session('alert')}}</div>
    </div>
@endif