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
                                <!-- FORM OPEN -->
                                @include('package-category::admin.partials.form_open', [
                                    'method' => 'POST',
                                    'action' => route('users.profile.editPost'),
                                    'model' => $user_profile
                                ])

                                <div class="row">
    <div class="col-md-6 col-xs-12">
        {{-- Password --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'name' => 'password',
                'label' => trans($plang_admin.'.labels.new-password'),
                'class' => 'form-control',
                'type' => 'password',
                'hidden' => true,
            ])

        </div>
       <span class="text-danger">{{ $errors->first('password') }}</span>

        {{-- Password Confirmation --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
    'name' => 'password_confirmation',
    'label' => trans($plang_admin.'.labels.confirm-password'),
    'class' => 'form-control',
    'type' => 'password',
    'hidden' => true
])

        </div>

        {{-- Code --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.code'),
                'name'  => 'code',
                'id'    => 'code',
                'class' => 'form-control'
            ])

        </div>
            <span class="text-danger">{{ $errors->first('code') }}</span>
        {{-- First name --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.first_name'),
                'name'  => 'first_name',
                'id'    => 'first_name',
                'class' => 'form-control'
            ])
        </div>
       <span class="text-danger">{{ $errors->first('first_name') }}</span>
        {{-- Last name --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.last_name'),
                'name'  => 'last_name',
                'id'    => 'last_name',
                'class' => 'form-control'
            ])
        </div>
        <span class="text-danger">{{ $errors->first('last_name') }}</span>
        {{-- Phone --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.phone'),
                'name'  => 'phone',
                'id'    => 'phone',
                'class' => 'form-control'
            ])
        </div>
        <span class="text-danger">{{ $errors->first('phone') }}</span>

        {{-- State --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.state'),
                'name'  => 'state',
                'id'    => 'state',
                'class' => 'form-control'
            ])
        </div>

    </div>

    <div class="col-md-6 col-xs-12">
        {{-- VAT --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.vat'),
                'name'  => 'var',
                'id'    => 'var',
                'class' => 'form-control'
            ])

            <span class="text-danger">{{ $errors->first('vat') }}</span>
        </div>

        {{-- City --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.city'),
                'name'  => 'city',
                'id'    => 'city',
                'class' => 'form-control'
            ])
            <span class="text-danger">{{ $errors->first('city') }}</span>
        </div>

        {{-- Country --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.country'),
                'name'  => 'country',
                'id'    => 'country',
                'class' => 'form-control'
            ])
            <span class="text-danger">{{ $errors->first('country') }}</span>
        </div>

        {{-- Sex --}}
        <div class="form-group">
            @include('package-category::admin.partials.select_single', [
                'name' => 'sex',
                'label' => trans($plang_admin.'.labels.sex'),
                'value' => null,
                'items' => trans($plang_admin . '.sex'),
                'class' => 'form-control',
            ])
            <span class="text-danger">{{ $errors->first('sex') }}</span>
        </div>

        {{-- Device Token --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.device_token'),
                'name'  => 'device_token',
                'id'    => 'device_token',
                'class' => 'form-control'
            ])
            <span class="text-danger">{{ $errors->first('device_token') }}</span>
        </div>

        {{-- Level --}}
        <div class="form-group">
            @include('package-category::admin.partials.select_single', [
                'name' => 'level_id',
                'label' => trans($plang_admin.'.labels.level'),
                'value' => null,
                'items' => $pluck_select_category_level,
                'class' => 'form-control',
            ])
            <span class="text-danger">{{ $errors->first('level_id') }}</span>
        </div>

        {{-- Category --}}
        <div class="form-group">
            @include('package-category::admin.partials.select_single', [
                'name' => 'category_id',
                'label' => trans($plang_admin.'.labels.category'),
                'value' => null,
                'items' => $pluck_select_category_department,
                'class' => 'form-control',
            ])
            <span class="text-danger">{{ $errors->first('category_id') }}</span>
        </div>

        {{-- Address --}}
        <div class="form-group">
            @include('package-category::admin.partials.input_text', [
                'label' => trans($plang_admin.'.labels.address'),
                'name'  => 'address',
                'id'    => 'address',
                'class' => 'form-control'
            ])
            <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>

        {{-- Custom Profile Fields --}}
        @foreach($custom_profile->getAllTypesWithValues() as $profile_data)
            <div class="form-group">
                @include('package-category::admin.partials.input_text', [
                    'label' => $profile_data->description,
                    'name'  => "custom_profile_{$profile_data->id}",
                    'value' => $profile_data->value,
                    'class' => 'form-control'
                ])
            </div>
        @endforeach

        {{-- Hidden fields + Submit --}}
        @include('package-category::admin.partials.input_text', [
             'hidden' => true,
             'name'   => 'user_id',
             'id'     => 'user_id',
             'value'  => $user_profile->user_id
         ])

        @include('package-category::admin.partials.input_text', [
            'hidden' => true,
            'name'   => 'id',
            'id'     => 'id',
            'value'  => $user_profile->id
        ])

        @include('package-category::admin.partials.btn_submit', [
            'label' => 'Save',
            'class' => 'btn btn-info pull-right margin-bottom-30',
        ])

    </div>
</div>


<!-- FORM CLOSE -->
@include('package-category::admin.partials.form_close')
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
