<!--
| @TITLE
| Sign up page
|
|-------------------------------------------------------------------------------
| @REQUIRED
|
|
|÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷
| @DESCRIPTION
|
|------------------------------------------------------------------------------>

@extends('package-acl::client.layouts.base')

@section ('title')
   {!! trans($plang_front.'.pages.signup') !!}
@stop

@section('head_css')
    {!!  HTML::style('packages/foostart/css/strength.css')  !!}
@stop

@section('content')
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">{!! trans($plang_front.'.pages.signup') !!}</h3>
                </div>

                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                    <div class="alert alert-success">{!! $message !!}</div>
                @endif

                <!--panel-body-->
                <div class="my-acl-form panel-body">
                    {!! Form::open(["route" => 'user.signup.process', "method" => "POST", "id" => "user_signup"]) !!}
                    {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                    {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}

                        <!--user name-->
                        <div class="row">

                            <!--first name-->
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                @include('package-category::front.partials.input_text', [
                                    'name' => 'first_name',
                                    'placeholder' => trans($plang_front.'.labels.first_name'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-user"></i></span>',
                                    'required' => true,
                                    'errors' => $errors
                                ])
                            </div>

                            <!--last name-->
                            <?php $name = 'last_name' ?>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                @include('package-category::front.partials.input_text', [
                                    'name' => 'last_name',
                                    'placeholder' => trans($plang_front.'.labels.last_name'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-user"></i></span>',
                                    'required' => true,
                                    'errors' => $errors
                                ])
                            </div>

                        </div>

                        <!--email-->
                        @include('package-category::front.partials.input_text', [
                                    'name' => 'email',
                                    'placeholder' => trans($plang_front.'.labels.email'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>',
                                    'required' => true,
                                    'errors' => $errors
                                ])

                        <!--password-->
                        <div class="row">
                            <!--password-->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                @include('package-category::front.partials.input_text', [
                                    'name' => 'password',
                                    'id' => 'password1',
                                    'placeholder' => trans($plang_front.'.labels.password'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-lock"></i></span>',
                                    'required' => true,
                                    'errors' => $errors,
                                    'type' => 'password'
                                ])
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                @include('package-category::front.partials.input_text', [
                                    'name' => 'password_confirmation',
                                    'id' => 'password2',
                                    'placeholder' => trans($plang_front.'.labels.confirm_password'),
                                    'icon' => '<span class="input-group-addon"><i class="fa fa-lock"></i></span>',
                                    'required' => true,
                                    'errors' => $errors,
                                    'password' => true,
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
                                        'placeholder' => trans($plang_front.'.labels.captcha'),
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
                                            <a id="captcha-gen-button" href="#" class="btn btn-small btn-info margin-left-5"><i class="fa fa-refresh"></i></a>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                        <input type="submit" value="{!! trans($plang_front.'.buttons.register') !!}" class="btn btn-info btn-block">
                        {!! Form::close() !!}

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
                            {!! link_to_route('user.login', trans($plang_front.'.pages.login')) !!}
                        </div>

<!--                        <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
                            {!! link_to_route('user.login.google', trans($plang_front.'.login-by-google')) !!}
                        </div>-->
                    </div>

                </div>
                <!--end panel body-->

            </div>
        </div>
    </div>

@stop

@section('footer_scripts')

    {!! HTML::script('packages/foostart/js/vendor/password_strength/strength.js') !!}

    @parent;

@stop
