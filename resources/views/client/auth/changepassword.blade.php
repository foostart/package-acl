@extends('package-acl::client.layouts.base')
@section('title')
    {!! trans($plang_front.'.pages.change-password') !!}
@stop
@section('content')
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {!! trans($plang_front.'.pages.change-password') !!}
                    </h3>
                </div>
                @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{!! $error !!}</div>
                    @endforeach
                @endif
                <div class="panel-body">
                
                    {{ html()->form('POST', route('user.reminder.process'))->open() }}
                    
	                    <div class="row">
	                        <div class="col-xs-12 col-sm-12 col-md-12">
	                            <div class="form-group">
	                                {!! html()->label(trans($plang_front.'.labels.new-password'))->for('password') !!}
	                                <div class="input-group">
	                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
	                                    {!! html()->password('password')
	                                        ->id('password')
	                                        ->class('form-control')
	                                        ->placeholder(trans($plang_front.'.labels.new-password'))
	                                        ->required()
	                                        ->autocomplete('off') !!}
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    {{ html()->submit(trans($plang_front.'.buttons.change_password'))->class('btn btn-info btn-block') }}

                        {!! html()->hidden('email')->value($email) !!}
                        {!! html()->hidden('token')->value($token) !!}
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@stop
