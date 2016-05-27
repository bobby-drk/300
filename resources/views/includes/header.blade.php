<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><img src='/assets/images/pin.png' style='margin-top:-15px;'/></a>
            <ul class="nav navbar-nav">
                <li class="{{ CustomHelpers::isActiveRoute('scores') }}"><a href="{{ route('scores')}}">Scores</a></li>
                <li class="{{ CustomHelpers::isActiveRoute('pay') }}"><a href="{{ route('pay')}}">Pay</a></li>
            </ul>

        </div>
    </div>
</nav>
