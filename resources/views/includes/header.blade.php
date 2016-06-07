<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><img src='/assets/images/pin.png' style='margin-top:-15px;'/></a>
            <ul class="nav navbar-nav">
                <li class="{{ CustomHelpers::isActiveRoute('dashboard') }}"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                @if (Auth::check())
                    <li><p class="navbar-text reduce-margin">{{Auth::user()->first_name}}</p></li>
                @endif
            </ul>

        </div>
    </div>
</nav>
