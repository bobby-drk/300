@if (Alert::check())
    @foreach (Alert::get() as $i => $alert)
        <p class="alert alert-{{ isset($alert['alert_type']) ? $alert['alert_type'] : 'success' }}">

            @if(isset($alert['dismissible']) && $alert['dismissible'] == TRUE)
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @endif

            {{ $alert['alert'] }}

        </p>
    @endforeach
@endif

@if (Session::has('status'))
    <p class="alert alert-success">{{ Session::get('status') }}</p>
@endif


@if (isset($errors) && $errors->any())
    @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
    @endforeach
@endif