@if(session('success'))
    <div class="alert alert-success alert-bordered alert-dismissable fade show">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-bordered alert-dismissable fade show">
        {{ session('error') }}
    </div>
@endif



