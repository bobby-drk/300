@extends('layouts.default')

@section('page-title')
    Dashboard
@stop

@section('content')
    <div class="row well strong_small_boarder">
        <table class='table table-striped'>
            <tr>
                <th>Bowler</th>
                <th>Pay Ratio</th>
                <th>Last Paid</th>
            </tr>
            @var('i', 0)
            @foreach($balance_ratio as $id => $user)
                <tr @if($i == 0)
                    class='danger'
                @elseif ($i == 1)
                    class='warning'
                @endif >

                    <td >{{$user->first_name}} @if ($user->id == Auth::id()) - <a href="{{ route("mybalance") }}">My Balance</a>@endif</td>
                    <td >{{number_format($user->pay_ratio, 3)}}</td>
                    <td >
                        @if(isset($paid_dates[$user->id]))
                            {{ $paid_dates[$user->id] }}
                        @else
                            &nbsp;
                        @endif
                    </td>
                </tr>
                <!-- {{ $i++ }} -->
            @endforeach
        </table>
        <div>* 1 means fully paid, fully played</div>

<br />
<br />
<br />
<br />

        <div>PR</div>
        <div>Bowling Scores over time graph</div>
    </div>
@stop
