@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans('jacopo-admin.pages.user-edit-profile') !!}
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
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! trans('jacopo-admin.labels.user-profile') !!}</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{!! URL::route('users.edit',['id' => $user_profile->user_id]) !!}" class="btn btn-info pull-right"><i class="fa fa-pencil-square-o"></i> {!! trans('jacopo-admin.labels.edit-user') !!}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        @if(! $use_gravatar)
                            @include('laravel-authentication-acl::admin.user.partials.avatar_upload')
                        @else
                            @include('laravel-authentication-acl::admin.user.partials.show_gravatar')
                        @endif
                        <h4><i class="fa fa-cubes"></i>{!! trans('jacopo-admin.labels.user-data').':' !!}</h4>
                        {!! Form::model($user_profile,['route'=>'users.profile.edit', 'method' => 'post']) !!}
               
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                         <!-- password text field -->
                                 <div class="form-group">
                            {!! Form::label('password',trans('jacopo-admin.labels.new-password').':') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('password') !!}</span>
                        <!-- password_confirmation text field -->
                        <div class="form-group">
                            {!! Form::label('password_confirmation',trans('jacopo-admin.labels.confirm-password').':') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>
                        <!-- code text field -->
                        <div class="form-group">
                            {!! Form::label('code',trans('jacopo-admin.labels.code').':') !!}
                            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('code') !!}</span>
                        <!-- first_name text field -->
                        <div class="form-group">
                            {!! Form::label('first_name',trans('jacopo-admin.labels.first_name').':') !!}
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('first_name') !!}</span>
                        <!-- last_name text field -->
                        <div class="form-group">
                            {!! Form::label('last_name',trans('jacopo-admin.labels.last_name').':') !!}
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                        <!-- phone text field -->
                        <div class="form-group">
                            {!! Form::label('phone',trans('jacopo-admin.labels.phone').':') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('phone') !!}</span>
                        <!-- state text field -->
                        <div class="form-group">
                            {!! Form::label('state',trans('jacopo-admin.labels.state').':') !!}
                            {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('state') !!}</span>
                            </div>
                            <div class="col-md-6 col-xs-12">
                         
                        <!-- var text field -->
                        <div class="form-group">
                            {!! Form::label('var',trans('jacopo-admin.labels.vat').':') !!}
                            {!! Form::text('var', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('vat') !!}</span>
                        <!-- city text field -->
                        <div class="form-group">
                            {!! Form::label('city',trans('jacopo-admin.labels.city').':') !!}
                            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('city') !!}</span>
                        <!-- country text field -->
                        <div class="form-group">
                            {!! Form::label('country',trans('jacopo-admin.labels.country').':') !!}
                            {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('country') !!}</span>
                        <!-- sex text field -->
                        <div class="form-group">
                            {!! Form::label('sex',trans('jacopo-admin.labels.sex').':') !!}
                            <?php $sex_values = trans('foo-admin.sex'); ?>
                            {!! Form::select('sex', $sex_values, null, ["class" => "form-control"]) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('sex') !!}</span>
                        <!-- level text field -->
                        <div class="form-group">
                           
                            {!! Form::label('level_id',trans('jacopo-admin.labels.level').':') !!}
                            {!! Form::select('level_id', $pluck_select_category_level, null, ["class" => "form-control"]) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('level_id') !!}</span>
                        <!-- category_id text field -->
                        <div class="form-group">
                            {!! Form::label('category_id',trans('jacopo-admin.labels.category').':') !!}
                            {!! Form::select('category_id', $pluck_select_category_department, null, ["class" => "form-control"]) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('category_id') !!}</span>

                        <!-- address text field -->
                        <div class="form-group">
                            {!! Form::label('address',trans('jacopo-admin.labels.address').':') !!}
                            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('address') !!}</span>
                        {{-- custom profile fields --}}
                        @foreach($custom_profile->getAllTypesWithValues() as $profile_data)
                        <div class="form-group">
                            {!! Form::label($profile_data->description) !!}
                            {!! Form::text("custom_profile_{$profile_data->id}", $profile_data->value, ["class" => "form-control"]) !!}
                            {{-- delete field --}}
                        </div>
                        @endforeach

                        {!! Form::hidden('user_id', $user_profile->user_id) !!}
                        {!! Form::hidden('id', $user_profile->id) !!}
                        {!! Form::submit('Save',['class' =>'btn btn-info pull-right margin-bottom-30']) !!}
                        {!! Form::close() !!}
                    </div>
                            </div>
                        </div>
                    <div class="col-md-6 col-xs-12">
                        @if($can_add_fields)
                        @include('laravel-authentication-acl::admin.user.custom-profile')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
