@extends('layouts.default')

@push('page-js')
    <script src="{{ URL::asset('assets/js/ledger.js') }}"></script>
@endpush()


@section('page-title')
    Record Bowling
@stop

@section('content')

@section('content')
{{ Form::hidden('api_token', Auth::user()->api_token, array('id' => 'api_token')) }}
{{ Form::hidden('credit_type', "bowling", array('id' => 'credit_type')) }}

    <div class='well strong_small_boarder'>
            <fieldset>
                <legend><i class='glyphicon glyphicon-record'></i> Record Bowling</legend>

                <div id='message' class='alert alert-warning' style='display:none;'></div>
                <div id='ledger_loader' style='text-align:center; display:none;'><img src='/assets/images/fire_ball.gif' style='height:75px;'></div>

                <div id='frm_holder'>

                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('amount', 'Total Amount') !!}
                            {!! Form::number('amount', "", ["id" => "ledger_amount", "class" => "form-control"]) !!}
                        </div>
                    </div>
                        @include('includes.user_select')
                        @include('includes.guest')

                    <div class="row vertical_offset_s">
                        <div class="col-md-4">
                            {!!Form::button('Record', ["id" => "record_ledger", "class"=>"btn btn-primary btn-sm"])!!}
                        </div>
                    </div>

                </div>

            </fieldset>
    </div>

@stop
