@extends('layouts.default')

@section('page-title')
Pay Place
@stop

@section('content')
    Show Pay Turns<br />
    who paid last time<br/>

<div><a href="{{ route("record_food") }}">Record Food</a></div>
<div><a href="{{ route("record_bowling") }}">Record Bowling</a></div>

@stop
