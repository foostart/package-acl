<!--
| @TITLE
| Recovery password
|
|-------------------------------------------------------------------------------
| @REQUIRED
|
|
|÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷
| @DESCRIPTION
|
------------------------------------------------------------------------------->
@extends('laravel-authentication-acl::client.layouts.base')

@section ('title')
    {!! trans('jacopo-front.recovery-password') !!}
@stop

@section('content')
<div class="row centered-form">
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-info">

            <div class="panel-heading">
                <h3 class="panel-title">
                    {!! trans('jacopo-front.recovery-password') !!}
                </h3>
            </div>

            @if($errors && ! $errors->isEmpty() )
                @foreach($errors->all() as $error)

                    <div class="alert alert-danger">{{$error}}</div>

                @endforeach
            @endif

            <div class="panel-body">

                {!! Form::open(array('url' => URL::route("user.reminder"), 'method' => 'post') ) !!}

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">

                         <!--email-->
                        @include('laravel-authentication-acl::client.partials.input_text', [
                                    'name' => 'email',
                                    'placeholder' => trans('jacopo-front.recovery-email'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>',
                                    'required' => true,
                                    'errors' => $errors
                                ])
                    </div>
                </div>

                <div class="row">
                    <!--captcha-->
                    @if(isset($captcha) )
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            @include('laravel-authentication-acl::client.partials.input_text', [
                                'name' => 'captcha_text',
                                'placeholder' => trans('jacopo-front.captcha'),
                                'icon' => '<span class="input-group-addon"><i class="fa fa-braille" aria-hidden="true"></i></span>',
                                'required' => true,
                                'errors' => $errors,
                                'password' => true
                            ])
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span id="captcha-img-container">
                                        @include('laravel-authentication-acl::client.auth.captcha-image')
                                    </span>
                                    <a id="captcha-gen-button" href="#" class="btn btn-small btn-info margin-left-5">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <input type="submit" value="{!! trans('jacopo-front.btn-recover') !!}" class="btn btn-info btn-block">

                {!! Form::close() !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
                        <a href="{!! URL::route('user.login') !!}">
                            <i class="fa fa-arrow-left"></i>
                            {!! trans('jacopo-front.to-login') !!}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@stop

@section('footer_scripts')

    @include('laravel-authentication-acl::assets.lib_js')

    @parent;
@stop