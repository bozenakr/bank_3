<div class="container">
    <div class="hide" style="with: 100%">
        @if($errors)
        @foreach ($errors->all() as $message)
        <div class="alert alert-danger m-4 alert-dismissible fade show" role="alert">
            {{ $message }}
        </div>
    </div>
    @endforeach
    @endif

    @if(Session::has('ok'))
    <div class="container">
        <div class="hide" style="with: 100%">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('ok') }}
            </div>
        </div>
    </div>
    @endif

    @if(Session::has('no'))
    <div class="container">
        <div class="hide" style="with: 100%">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('no') }}
            </div>
        </div>
    </div>
    @endif
</div>
