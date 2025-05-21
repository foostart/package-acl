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
                    <!-- FORM OPEN -->
                    @include('package-category::admin.partials.form_open', [
                        'method' => 'POST',
                        'action' => route('user.login.process'),
                    ])

                    <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        @include('package-category::admin.partials.input_text', [
                                            'name' => 'email',
                                            'id' => 'email',
                                            'class' => 'form-control',
                                            'placeholder' => trans($plang_front.'.labels.email'),
                                            'required' => true,
                                            'autocomplete' => 'off'
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        @include('package-category::admin.partials.input_text', [
                                            'name' => 'password',
                                            'class' => 'form-control',
                                            'placeholder' => trans($plang_front.'.labels.password'),
                                            'required' => true,
                                            'type' => 'password',
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ html()->label('Remember me')->for('remember') }}
                            {{ html()->checkbox('remember') }}
                        </div>

                        <input type="submit" value="Login" class="btn btn-info btn-block">
                    <!-- FORM CLOSE -->
                    @include('package-category::admin.partials.form_close')

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
