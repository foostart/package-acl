@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
    {!! trans('jacopo-front.page-change-password') !!}
@stop
@section('content')
<div class="row centered-form">
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {!! trans('jacopo-front.page-change-password') !!}
                </h3>
            </div>
            @if($errors && ! $errors->isEmpty() )
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">{!! $error !!}</div>
                @endforeach
            @endif
            <div class="panel-body">
                {!! Form::open(array('url' => URL::route("user.reminder.process"), 'method' => 'post') ) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('password', trans('jacopo-front.new-password')) !!}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => trans('jacopo-front.new-password'), 'required', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="{!! trans('jacopo-front.btn-change-password') !!}" class="btn btn-info btn-block">
                {!! Form::hidden('email',$email) !!}
                {!! Form::hidden('token',$token) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop