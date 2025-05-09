@extends('package-acl::admin.layouts.baseauth')

@section('title')
    Admin login
@stop

@section('container')
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        Login to {!! Config::get('acl_base.app_name') !!}
                    </h3>
                </div>

                <?php $message = Session::get('message'); ?>
                @if (isset($message))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif

                @if ($errors && !$errors->isEmpty())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                <div class="my-acl-form panel-body">
                    {{ html()->form('POST', route('user.login.process'))->open() }}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        {{ html()->email('email')
                                            ->id('email')
                                            ->class('form-control')
                                            ->placeholder(trans($plang_front.'.labels.email'))
                                            ->attribute('required')
                                            ->attribute('autocomplete', 'off') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        {{ html()->password('password')
                                            ->class('form-control')
                                            ->placeholder(trans($plang_front.'.labels.password'))
                                            ->required() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ html()->label('Remember me')->for('remember') }}
                            {{ html()->checkbox('remember') }}
                        </div>

                        <input type="submit" value="Login" class="btn btn-info btn-block">
                    {{ html()->form()->close() }}

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
                            <a href="{{ route('user.reminder.process') }}">Forgot password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
