@extends('layouts.default')

@push('page-js')
    <script src="{{ URL::asset('assets/js/scores.js') }}"></script>
@endpush()

@section('page-title')
    Record Scores
@stop

@section('content')
{{ Form::hidden('api_token', Auth::user()->api_token, array('id' => 'api_token')) }}

    <div class='well'>
            <fieldset>
                <legend><i class='glyphicon glyphicon-record'></i> Record Scores</legend>

                <div id='message' class='alert alert-warning' style='display:none;'></div>
                <div id='score_loader' style='text-align:center; display:none;'><img src='/assets/images/fire_ball.gif' style='height:75px;'></div>

                <div id='frm_holder'>

<!--                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('score', 'Bowling Score') !!}
                            {!! Form::text('score', "", ["id" => "bowling_score", "class" => "form-control"]) !!}
                        </div>
                    </div>
                        
                    <div class="row vertical_offset_s">
                        <div class="col-md-4">
                            {!!Form::button('Record', ["id" => "record_score", "class"=>"btn btn-primary btn-sm"])!!}
                        </div>
                    </div>-->
                    
                    <div class="form-group">
                        <label class="control-label">Bowling Score</label>
                        <div class="input-group">
                            {!! Form::text('score', "", ["id" => "bowling_score", "class" => "form-control"]) !!}
                            <span class="input-group-btn">
                                {!!Form::button('Record', ["id" => "record_score", "class"=>"btn btn-primary"])!!}
                            </span>
                        </div>
                    </div>

                </div>

            </fieldset>
    </div>
{{$pr}}


@stop