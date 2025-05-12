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
                        <div class="col-md-6 col-xs-12">
                            @if(! $use_gravatar)
                                @include('package-acl::admin.user.partials.selfavatar_upload')
                            @else
                                @include('package-acl::admin.user.partials.show_gravatar')
                            @endif
                            <h4><i class="fa fa-cubes"></i> {!! trans($plang_admin.'.labels.user-data').':' !!}</h4>
                            <!-- FORM OPEN -->
                            @include('package-category::admin.partials.form_open', [
                                'method' => 'POST',
                                'action' => route('users.profile.edit')
                            ])

                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <!-- Password -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.new-password').':', 'password') !!}
                                        {!! html()->password('password')->class('form-control') !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('password') !!}</span>

                                    <!-- Password Confirmation -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.confirm-password').':', 'password_confirmation') !!}
                                        {!! html()->password('password_confirmation')->class('form-control') !!}
                                    </div>

                                    <!-- First Name -->
                                    <div class="form-group">
                                        @include('package-category::admin.partials.input_text', [
                                            'label' => trans($plang_admin.'.labels.first_name').':',
                                            'name'  => 'first_name',
                                            'value' => old('first_name', $user_profile->first_name),
                                            'class' => 'form-control'
                                        ])
                                    </div>
                                    <span class="text-danger">{!! $errors->first('first_name') !!}</span>

                                    <!-- Last Name -->
                                    <div class="form-group">
                                        @include('package-category::admin.partials.input_text', [
                                            'label' => trans($plang_admin.'.labels.last_name').':',
                                            'name'  => 'last_name',
                                            'value' => old('last_name', $user_profile->last_name),
                                            'class' => 'form-control'
                                        ])
                                    </div>
                                    <span class="text-danger">{!! $errors->first('last_name') !!}</span>

                                    <!-- Phone -->
                                    <div class="form-group">
                                        @include('package-category::admin.partials.input_text', [
                                            'label' => trans($plang_admin.'.labels.phone').':',
                                            'name'  => 'phone',
                                            'value' => old('phone', $user_profile->phone),
                                            'class' => 'form-control'
                                        ])
                                    </div>
                                    <span class="text-danger">{!! $errors->first('phone') !!}</span>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <!-- Address -->
                                    <div class="form-group">
                                        @include('package-category::admin.partials.input_text', [
                                            'label' => trans($plang_admin.'.labels.address').':',
                                            'name'  => 'address',
                                            'value' => old('address', $user_profile->address),
                                            'class' => 'form-control'
                                        ])

                                    </div>
                                    <span class="text-danger">{!! $errors->first('address') !!}</span>

                                    <!-- City -->
                                    <div class="form-group">
                                        @include('package-category::admin.partials.input_text', [
                                            'label' => trans($plang_admin.'.labels.city').':',
                                            'name'  => 'city',
                                            'value' => old('city', $user_profile->city),
                                            'class' => 'form-control'
                                        ])
                                    </div>
                                    <span class="text-danger">{!! $errors->first('city') !!}</span>

                                    <!-- Sex -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.sex').':', 'sex') !!}
                                        {!! html()->select('sex', trans('acl-admin.sex'), old('sex', $user_profile->sex))->class('form-control') !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('sex') !!}</span>

                                    <!-- Category -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.category').':', 'category_id') !!}
                                        {!! html()->select('category_id', $pluck_select_category_department, old('category_id', $user_profile->category_id))->class('form-control') !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('category_id') !!}</span>

                                    {{-- Custom profile fields --}}
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
                                        'class' => 'btn btn-info pull-right margin-bottom-30'
                                    ])

                                   <!-- FORM CLOSE -->
                                    @include('package-category::admin.partials.form_close')
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
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
