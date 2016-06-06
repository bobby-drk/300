@extends('layouts.default')

@section('page-title')
Pay Place
@stop

@section('content')

<a href="{{ route("record_food") }}" class="btn btn-default btn-sm btn-block">Record Food</a>
<a href="{{ route("record_bowling") }}" class="btn btn-default btn-sm btn-block">Record Bowling</a>

@stop
