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
                        <!-- FORM OPEN -->
                        @include('package-category::admin.partials.form_open', [
                            'method' => 'POST',
                            'action' => route('users.editPost'),
                        ])

                        {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                        @include('package-category::admin.partials.input_text', [
                            'name' => '__to_hide_password_autocomplete',
                            'hidden' => true,
                            'class' => 'hidden',
                            'type' => 'password',
                        ])
                        @include('package-category::admin.partials.input_text', [
                            'hidden' => true,
                            'name'   => 'id',
                            'id'     => 'id',
                            'value'  => @$user->id
                        ])

                        @include('package-category::admin.partials.input_text', [
                            'hidden' => true,
                            'name'   => 'form_name',
                            'id'     => 'form_name',
                            'value'  => 'user'
                        ])
                        <!-- email text field -->
                        <div class="form-group">
                            @include('package-category::admin.partials.input_text', [
                                'name' => 'email',
                                'label' => trans($plang_admin.'.labels.email').':*',
                                'value' => @$user->email,
                                'errors' => $errors,
                                'class' => 'form-control',
                                'placeholder' => trans($plang_admin.'.labels.email')
                            ])
                        </div>

                        <!-- Password -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('package-category::admin.partials.input_text', [
                                        'name' => 'password',
                                        'label' => isset($user->id)
                                            ? trans($plang_admin.'.labels.change-password') . ':'
                                            : trans($plang_admin.'.labels.password') . ':',
                                        'class' => 'form-control',
                                        'autocomplete' => 'off',
                                        'placeholder' => '',
                                        'type' => 'password'
                                    ])

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('package-category::admin.partials.input_text', [
                                        'name' => 'password_confirmation',
                                        'label' => isset($user->id)
                                            ? trans($plang_admin.'.labels.confirm-change-password') . ':'
                                            : trans($plang_admin.'.labels.confirm-password') . ':',
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'autocomplete' => 'off',
                                        'type' => 'password',
                                    ])

                                </div>
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            </div>
                        </div>
                        <!-- End Password -->

                        <!-- Status -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('package-category::admin.partials.select_single', [
                                        'name' => 'activated',
                                        'label' => trans($plang_admin.'.labels.active'),
                                        'value' => (isset($user->activated) && $user->activated) ? $user->activated : '0',
                                        'items' => ['1' => 'Yes', '0' => 'No'],
                                        'class' => 'form-control',
                                    ])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('package-category::admin.partials.select_single', [
                                        'name' => 'banned',
                                        'label' => trans($plang_admin.'.labels.banned'),
                                        'value' => (isset($user->banned) && $user->banned) ? $user->banned : '0',
                                        'items' => ['1' => 'Yes', '0' => 'No'],
                                        'class' => 'form-control',
                                    ])
                                </div>
                            </div>
                            @if(isset($user->suspended) && $user->suspended)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        @include('package-category::admin.partials.checkbox', [
                                            'name' => 'suspended',
                                            'label' => trans($plang_admin.'.labels.suspended'),
                                            'value' => (isset($user->suspended) && $user->suspended) ? true : false
                                        ])
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- End status -->

                        <!--BUTTONS-->
                        <div class='btn-form'>
                            <a href="{!! URL::route('users.profile.editGet',['user_id' => $user->id]) !!}"
                               class="btn btn-primary pull-right margin-left-5" {!! ! isset($user->id) ? 'disabled="disabled"' : '' !!}>
                                <i class="fa fa-user"></i> Edit profile</a>

                            @if($user->deleted_at)
                                <a href="{!! URL::route('users.restore',['id' => $user->id, '_token' => csrf_token()]) !!}"
                                   class="btn btn-success pull-right margin-left-5 restore">
                                    {!! trans($plang_admin.'.buttons.restore') !!}
                                </a>
                            @else
                                <a href="{!! URL::route('users.delete',['id' => $user->id, '_token' => csrf_token()]) !!}"
                                   class="btn btn-warning pull-right margin-left-5 delete">
                                    {!! trans($plang_admin.'.buttons.delete') !!}
                                </a>
                            @endif
                            @include('package-category::admin.partials.btn_submit', [
                                'label' => trans($plang_admin.'.buttons.save'),
                                'class' => 'btn btn-info pull-right'
                            ])

                        </div>
			<!-- FORM CLOSE -->
            @include('package-category::admin.partials.form_close')

                    </div>

                    <div class="col-md-6 col-xs-6">
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
        $(".restore").click(function () {
            return confirm("{!! trans($plang_admin.'.messages.user-restore') !!}");
        });
    </script>
@stop
