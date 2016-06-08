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
            </tr>
            @var('i', 0)
            @foreach($balance_ratio as $user => $ratio)
                <tr @if($i == 0)
                    class='danger'
                @elseif ($i == 1)
                    class='warning'
                @endif >

                    <td >{{$user}}</td>
                    <td >{{number_format($ratio - 1, 3)}}</td>
                </tr>
                <!-- {{ $i++ }} -->
            @endforeach
        </table>
        <div>* zero means fully paid, fully played</div>

<br />
<br />
<br />
<br />

        <div>PR</div>
        <div>Bowling Scores over time graph</div>
    </div>
@stop
