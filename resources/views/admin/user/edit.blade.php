@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.user-edit') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            {{-- successful message --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
            @endif
            @if($errors->has('model') )
                <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="panel-title bariol-thin">
                                {!! isset($user->id) ? '<i class="fa fa-pencil"></i> Edit user' : '<i class="fa fa-user"></i> Create user' !!}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <a href="{!! URL::route('users.profile.edit',['user_id' => $user->id]) !!}"
                               class="btn btn-info pull-right" {!! ! isset($user->id) ? 'disabled="disabled"' : '' !!}><i
                                        class="fa fa-user"></i> Edit profile</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <h4>{!! trans($plang_admin.'.labels.login-data') !!} </h4>
                    {!! Form::model($user, [ 'url' => URL::route('users.edit')] )  !!}
                        {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                        {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                        {!! Form::hidden('id') !!}
                        {!! Form::hidden('form_name','user') !!}

                        <!-- email text field -->
                        <div class="form-group">
                            {!! Form::label('email',trans($plang_admin.'.labels.email').':*') !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'user email', 'autocomplete' => 'off']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('email') !!}</span>

                        <!-- Password -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- password text field -->
                                <div class="form-group">
                                    {!! Form::label('password',isset($user->id) ? trans($plang_admin.'.labels.change-password').':' : trans($plang_admin.'.labels.password').':') !!}
                                    {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('password') !!}</span>
                            </div>
                            <div class="col-md-6">
                                <!-- password_confirmation text field -->
                                <div class="form-group">
                                    {!! Form::label('password_confirmation',isset($user->id) ? trans($plang_admin.'.labels.confirm-change-password').':' : trans($plang_admin.'.labels.confirm-password').':') !!}
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '','autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('password_confirmation') !!}</span>
                            </div>
                        </div>
                        <!-- End Password -->

                        <!-- Status -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label("activated",trans($plang_admin.'.labels.active').':') !!}
                                    {!! Form::select('activated', ["1" => "Yes", "0" => "No"], (isset($user->activated) && $user->activated) ? $user->activated : "0", ["class"=> "form-control"] ) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label("banned",trans($plang_admin.'.labels.banned').':') !!}
                                    {!! Form::select('banned', ["1" => "Yes", "0" => "No"], (isset($user->banned) && $user->banned) ? $user->banned : "0", ["class"=> "form-control"] ) !!}
                                </div>
                            </div>
                        </div>
                        <!-- End status -->

                        <!--BUTTONS-->
                        <div class='btn-form'>
                            <a href="{!! URL::route('users.delete',['id' => $user->id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">Delete user</a>
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <h4><i class="fa fa-users"></i> {!! trans($plang_admin.'.labels.group').':' !!} </h4>
                        @include('package-acl::admin.user.groups')


                        <h4><i class="fa fa-lock"></i> {!! trans($plang_admin.'.labels.permission-name').':' !!}</h4>

                        @include('package-acl::admin.user.perm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer_scripts')
    <script>
        $(".delete").click(function () {
            return confirm("{!! trans($plang_admin.'.messages.user-delete') !!}");
        });
    </script>
@stop