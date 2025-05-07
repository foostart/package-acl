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
                            {!! html()->modelForm($user_profile, 'POST', route('users.profile.edit'))->open() !!}

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
                                        {!! html()->label(trans($plang_admin.'.labels.first_name').':', 'first_name') !!}
                                        {!! html()->text('first_name')->class('form-control')->value(old('first_name', $user_profile->first_name)) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('first_name') !!}</span>

                                    <!-- Last Name -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.last_name').':', 'last_name') !!}
                                        {!! html()->text('last_name')->class('form-control')->value(old('last_name', $user_profile->last_name)) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('last_name') !!}</span>

                                    <!-- Phone -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.phone').':', 'phone') !!}
                                        {!! html()->text('phone')->class('form-control')->value(old('phone', $user_profile->phone)) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('phone') !!}</span>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <!-- Address -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.address').':', 'address') !!}
                                        {!! html()->text('address')->class('form-control')->value(old('address', $user_profile->address)) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('address') !!}</span>

                                    <!-- City -->
                                    <div class="form-group">
                                        {!! html()->label(trans($plang_admin.'.labels.city').':', 'city') !!}
                                        {!! html()->text('city')->class('form-control')->value(old('city', $user_profile->city)) !!}
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
                                            {!! html()->label($profile_data->description) !!}
                                            {!! html()->text("custom_profile_{$profile_data->id}")->value($profile_data->value)->class('form-control') !!}
                                        </div>
                                    @endforeach

                                    {!! html()->hidden('user_id', $user_profile->user_id) !!}
                                    {!! html()->hidden('id', $user_profile->id) !!}
                                    {!! html()->submit('Save')->class('btn btn-info pull-right margin-bottom-30') !!}
                                    {!! html()->closeModelForm() !!}
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
