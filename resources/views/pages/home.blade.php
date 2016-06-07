@extends('layouts.default')

@section('page-title')
    The Only Bowling App
@stop

@section('content')
    <div class="row weak_small_boarder">

        <div class='col-md-4 vertical_offset_s'><a href="{{ route("scores") }}" class="btn btn-default btn-lg btn-block">Record score</a></div>
        <div class='col-md-4 vertical_offset_s'><a href="{{ route("record_food") }}" class="btn btn-default btn-lg btn-block">I paid for food</a></div>
        <div class='col-md-4 vertical_offset_s'><a href="{{ route("record_bowling") }}" class="btn btn-default btn-lg btn-block">I paid for bowling</a></div>

    </div>
@stop
