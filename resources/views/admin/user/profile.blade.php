@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.user-edit-profile') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            {{-- success message --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
            @endif
            @if( $errors->has('model') )
                <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="panel-title bariol-thin"><i
                                    class="fa fa-user"></i> {!! trans($plang_admin.'.labels.user-profile') !!}</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{!! URL::route('users.editGet',['id' => $user_profile->user_id]) !!}"
                               class="btn btn-info pull-right"><i
                                    class="fa fa-pencil-square-o"></i> {!! trans($plang_admin.'.labels.edit-user') !!}
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            @if(! $use_gravatar)
                                @include('package-acl::admin.user.partials.avatar_upload')
                            @else
                                @include('package-acl::admin.user.partials.show_gravatar')
                            @endif
                            <h4><i class="fa fa-cubes"></i>{!! trans($plang_admin.'.labels.user-data').':' !!}</h4>
				{!! html()->form('POST', route('users.profile.editPost'))->model($user_profile) !!}


<div class="row">
    <div class="col-md-6 col-xs-12">
        {{-- Password --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.new-password'))->for('password') }}
            {{ html()->password('password')->class('form-control') }}
        </div>
       <span class="text-danger">{{ $errors->first('password') }}</span>

        {{-- Password Confirmation --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.confirm-password'))->for('password_confirmation') }}
            {{ html()->password('password_confirmation')->class('form-control') }}
        </div>

        {{-- Code --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.code'))->for('code') }}
            {{ html()->text('code')->class('form-control') }}
        </div>
            <span class="text-danger">{{ $errors->first('code') }}</span>
        {{-- First name --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.first_name'))->for('first_name') }}
            {{ html()->text('first_name')->class('form-control') }}
        </div>       
       <span class="text-danger">{{ $errors->first('first_name') }}</span>
        {{-- Last name --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.last_name'))->for('last_name') }}
            {{ html()->text('last_name')->class('form-control') }}
        </div>
        <span class="text-danger">{{ $errors->first('last_name') }}</span>
        {{-- Phone --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.phone'))->for('phone') }}
            {{ html()->text('phone')->class('form-control') }}
        </div>
        <span class="text-danger">{{ $errors->first('phone') }}</span>

        {{-- State --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.state'))->for('state') }}
            {{ html()->text('state')->class('form-control') }}
        </div>
	
    </div>

    <div class="col-md-6 col-xs-12">
        {{-- VAT --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.vat'))->for('var') }}
            {{ html()->text('var')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('vat') }}</span>
        </div>

        {{-- City --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.city'))->for('city') }}
            {{ html()->text('city')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('city') }}</span>
        </div>

        {{-- Country --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.country'))->for('country') }}
            {{ html()->text('country')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('country') }}</span>
        </div>

        {{-- Sex --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.sex'))->for('sex') }}
            {{ html()->select('sex', trans($plang_admin.'.sex'))->class('form-control') }}
            <span class="text-danger">{{ $errors->first('sex') }}</span>
        </div>

        {{-- Device Token --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.device_token'))->for('device_token') }}
            {{ html()->text('device_token')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('device_token') }}</span>
        </div>

        {{-- Level --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.level'))->for('level_id') }}
            {{ html()->select('level_id', $pluck_select_category_level)->class('form-control') }}
            <span class="text-danger">{{ $errors->first('level_id') }}</span>
        </div>

        {{-- Category --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.category'))->for('category_id') }}
            {{ html()->select('category_id', $pluck_select_category_department)->class('form-control') }}
            <span class="text-danger">{{ $errors->first('category_id') }}</span>
        </div>

        {{-- Address --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.address'))->for('address') }}
            {{ html()->text('address')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>

        {{-- Custom Profile Fields --}}
        @foreach($custom_profile->getAllTypesWithValues() as $profile_data)
            <div class="form-group">
                {{ html()->label($profile_data->description) }}
                {{ html()->text("custom_profile_{$profile_data->id}", $profile_data->value)->class('form-control') }}
            </div>
        @endforeach

        {{-- Hidden fields + Submit --}}
        {{ html()->hidden('user_id', $user_profile->user_id) }}
        {{ html()->hidden('id', $user_profile->id) }}
        {{ html()->submit('Save')->class('btn btn-info pull-right margin-bottom-30') }}
    </div>
</div>


{{ html()->form()->close() }}
</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            @if($can_add_fields)
                                @include('package-acl::admin.user.custom-profile')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
