@extends('layouts.default')

@section('page-title')
    My Balance
@stop

@section('content')
    <div class="row well strong_small_boarder">
        <table class='table table-striped'>
            <tr>
                <th>Bowler</th>
                <th>Balance</th>
            </tr>
        @foreach($balance_sheet as $id => $user)
            <tr @if($user->balance < 0)
                class='danger'
            @endif >
                <td >{{$user->first_name}}</td>
                <td >${{number_format($user->balance, 2)}}</td>
            </tr>
        @endforeach
        </table>
        <div>* Negative balance means you owe them</div>
    </div>
@stop
