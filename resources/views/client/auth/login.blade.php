@extends('package-acl::client.layouts.base')
@section('title')
    {!! trans($plang_front.'.pages.login') !!}
@stop
@section('content')
<div class="row centered-form">
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">
                    {!! trans($plang_front.'.pages.login') !!}
                </h3>
            </div>
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
            <div class="alert alert-success">{!! $message !!}</div>
            @endif
            @if($errors && ! $errors->isEmpty() )
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{!! $error !!}</div>
            @endforeach
            @endif
            <div class="my-acl-form panel-body">
                {!! Form::open(array('url' => URL::route("user.login"), 'method' => 'post') ) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <!--email-->
                        @include('package-category::front.partials.input_text', [
                                    'name' => 'email',
                                    'placeholder' => trans($plang_front.'.labels.email'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>',
                                    'required' => true,
                                    'errors' => $errors
                                ])

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @include('package-category::front.partials.input_text', [
                                    'name' => 'password',
                                    'placeholder' => trans($plang_front.'.labels.password'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-lock"></i></span>',
                                    'required' => true,
                                    'errors' => $errors,
                                    'type' => 'password'
                                ])
                    </div>
                </div>

                <div class="row">
                    <!--captcha-->
                    @if(isset($captcha) )

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            @include('package-category::front.partials.input_text', [
                                'name' => 'captcha_text',
                                'placeholder' => trans($plang_front.'.captcha'),
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
                                        @include('package-acl::client.auth.captcha-image')
                                    </span>
                                    <a id="captcha-gen-button" href="#" class="btn btn-small btn-info margin-left-5">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>

                {!! Form::label('remember','Remember me') !!}
                {!! Form::checkbox('remember')!!}
                <input type="submit" value="Login" class="btn btn-info btn-block">
                {!! Form::close() !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
        {!! link_to_route('user.recovery-password','Forgot password?') !!}
        or <a href="{!! URL::route('user.signup') !!}"><i class="fa fa-sign-in"></i> Signup here</a>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
@stop
