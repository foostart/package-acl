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
                    <div class="col-md-6 col-xs-6">
                        <h4>{!! trans($plang_admin.'.labels.user-profile') !!} </h4>
                        {{ html()->form('POST', route('users.editPost'))->model($user)->open() }}
                        {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                        {{ html()->password('__to_hide_password_autocomplete')->class('hidden') }}
                        {{ html()->hidden('id') }}
                        {{ html()->hidden('form_name', 'user') }}

                        <!-- email text field -->
                        <div class="form-group">
                            {{ html()->label(trans($plang_admin.'.labels.email').':*')->for('email') }}
                            {{ html()->text('email')->class('form-control')->placeholder('user email')->autocomplete('off') }}
                        </div>
                        <span class="text-danger">{{ $errors->first('email') }}</span>

                        <!-- Password -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(isset($user->id) ? trans($plang_admin.'.labels.change-password').':' : trans($plang_admin.'.labels.password').':')->for('password') }}
                                    {{ html()->password('password')->class('form-control')->autocomplete('off')->placeholder('') }}
                                </div>
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(isset($user->id) ? trans($plang_admin.'.labels.confirm-change-password').':' : trans($plang_admin.'.labels.confirm-password').':')->for('password_confirmation') }}
                                    {{ html()->password('password_confirmation')->class('form-control')->placeholder('')->autocomplete('off') }}
                                </div>
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            </div>
                        </div>
                        <!-- End Password -->

                        <!-- Status -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
    {{ html()->label(trans($plang_admin.'.labels.active').':')->for('activated') }}
    {{ html()->select('activated', ["1" => "Yes", "0" => "No"], isset($user->activated) && $user->activated ? $user->activated : "0")->class('form-control') }}

