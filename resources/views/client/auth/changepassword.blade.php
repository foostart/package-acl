@extends('package-acl::client.layouts.base')
@section('title')
    {!! trans($plang_front.'.pages.change-password') !!}
@stop
@section('content')
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {!! trans($plang_front.'.pages.change-password') !!}
                    </h3>
                </div>
                @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{!! $error !!}</div>
                    @endforeach
                @endif
                <div class="panel-body">

                    <!-- FORM OPEN -->
                    @include('package-category::admin.partials.form_open', [
                        'method' => 'POST',
                        'action' => route('user.reminder.process')
                    ])


                    <div class="row">
	                        <div class="col-xs-12 col-sm-12 col-md-12">
	                            <div class="form-group">
	                                {!! html()->label(trans($plang_front.'.labels.new-password'))->for('password') !!}
	                                <div class="input-group">
	                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        @include('package-category::admin.partials.input_text', [
                                            'name' => 'password',
                                            'id' => 'password',
                                            'class' => 'form-control',
                                            'placeholder' => trans($plang_front.'.labels.new-password'),
                                            'required' => true,
                                            'autocomplete' => 'off',
                                            'hidden' => 'true',
                                            'type' => 'password',
                                        ])
	                                </div>
	                            </div>
	                        </div>
	                    </div>
                    @include('package-category::admin.partials.btn_submit', [
                        'label' => trans($plang_front.'.buttons.change_password'),
                        'class' => 'btn btn-info btn-block'
                        ])


                    @include('package-category::admin.partials.input_text', [
                         'hidden' => true,
                         'name'   => 'email',
                         'id'     => 'email',
                         'value'  => $email
                     ])

                    @include('package-category::admin.partials.input_text', [
                        'hidden' => true,
                        'name'   => 'token',
                        'id'     => 'token',
                        'value'  => $token
                    ])

                    <!-- FORM CLOSE -->
                    @include('package-category::admin.partials.form_close')
                </div>
            </div>
        </div>
    </div>
@stop
