@extends('layouts.default')

@section('page-title')
    The Only Bowling App
@stop

@section('content')

<h1>Rate Movies</h1>

<div class='well'>
    {!! Form::open(array('url' => 'rate/save', 'class' => 'form-horizontal')) !!}
    <fieldset>
        <legend><i class='glyphicon glyphicon-film'></i> Movie Title</legend>
        <div class="row">
            <div class="col-md-6">
                <div>
                    {!!Form::text('title', '', ["class"=>"form-control", "placeholder" => "Start Typing Movie Title Here"]) !!}
                </div>
            </div>
        </div>
    </fieldset>
</div>

<div class='well'>
    <fieldset>
        <legend><i class='glyphicon glyphicon-barcode'></i> Rating Info</legend>

        <div class="row vertical_offset_s">
            <div class="col-md-3">
                {!! Form::label('score', 'Overall Rating between 1 and 100') !!}
                <div>
                    {!!Form::text('score', '', ["class"=>"slider new_line", "data-slider-min"=>"0", "data-slider-max"=>"100", "data-slider-step"=>"1", "data-slider-value"=>"0"]) !!}
                </div>
            </div>
        </div>
        
        <div class="row vertical_offset_s">
            <div class="col-md-3">
                {!! Form::label('date', 'Date Watched') !!}
                {!!Form::date('date', '', ["class"=>"form-control"]) !!}
            </div>
        </div>
        
        <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!!Form::submit('Rate Movie', ["class"=>"btn btn-primary btn-sm", "id"=>"rate_movie"])!!}
                </div>
        </div>
        
    </fieldset>
</div>
        
<div id='flip' class='well well_open_panel'>
    <fieldset>
        <legend><i class='glyphicon glyphicon-play'></i> Click For Advanced Ratings</legend>
    </fieldset>
</div>


<div id='open_panel'>
    <fieldset>
        <div class='well'>
            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!! Form::label('directing', 'Rate the Directing') !!}
                    <div>
                        {!!Form::text('directing', '', ["class"=>"slider new_line", "data-slider-min"=>"0", "data-slider-max"=>"100", "data-slider-step"=>"1", "data-slider-value"=>"0"]) !!}
                    </div>
                </div>
            </div>

            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!! Form::label('lead_actors', 'Rate the Leading Actors') !!}
                    <div>
                        {!!Form::text('lead_actors', '', ["class"=>"slider new_line", "data-slider-min"=>"0", "data-slider-max"=>"100", "data-slider-step"=>"1", "data-slider-value"=>"0"]) !!}
                    </div>
                </div>
            </div>

            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!! Form::label('supporting_cast', 'Rate the Supporting Cast') !!}
                    <div>
                        {!!Form::text('supporting_cast', '', ["class"=>"slider new_line", "data-slider-min"=>"0", "data-slider-max"=>"100", "data-slider-step"=>"1", "data-slider-value"=>"0"]) !!}
                    </div>
                </div>
            </div>

            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!! Form::label('music', 'Rate the Music') !!}
                    <div>
                        {!!Form::text('music', '', ["class"=>"slider new_line", "data-slider-min"=>"0", "data-slider-max"=>"100", "data-slider-step"=>"1", "data-slider-value"=>"0"]) !!}
                    </div>
                </div>
            </div>

            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!! Form::label('experience', 'Experience') !!}
                    <div>
                        {!!Form::text('experience', '', ["class"=>"slider new_line", "data-slider-min"=>"0", "data-slider-max"=>"100", "data-slider-step"=>"1", "data-slider-value"=>"0"]) !!}
                    </div>
                </div>
            </div>

            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!! Form::label('mood', 'Mood') !!}
                    <div>
                        {!!Form::text('mood', '', ["class"=>"slider new_line", "data-slider-min"=>"0", "data-slider-max"=>"100", "data-slider-step"=>"1", "data-slider-value"=>"0"]) !!}
                    </div>
                </div>
            </div>

            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!! Form::label('with', 'Watched With') !!}
                    {!!Form::text('with', '', ["class"=>"form-control", "placeholder" => "SO, friend, Mom.... "]) !!}
                </div>
            </div>

            <div class="row vertical_offset_s">
                <div class="col-md-3">
                    {!!Form::submit('Rate Movie', ["class"=>"btn btn-primary btn-sm"])!!}
                </div>
            </div>
        </div>    
    </fieldset>
</div>


@stop