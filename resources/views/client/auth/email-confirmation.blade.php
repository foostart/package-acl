@extends('package-acl::client.layouts.base-fullscreen')
@section ('title')
    {!! trans($plang_front.'.pages.title-register-complelete') !!}
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 text-center v-center">
        @if($errors->has('token'))
            <h1>
                <i class="fa fa-bolt"></i>
                {!! trans($plang_front.'.messages.token-valid') !!}
            </h1>
        @elseif($errors->has('email'))
            <h1>
                <i class="fa fa-bolt"></i>
                {!! trans($plang_front.'.messages.email-valid') !!}
            </h1>
        @else
                <h1>
                    <i class="fa fa-thumbs-up"></i>
                    {!! trans($plang_front.'.messages.register-success') !!}
                    {!! Config::get('acl_base.app_name') !!}
                </h1>
                <p class="lead">
                    {!! trans($plang_front.'.messages.following-link') !!}
                    {!! link_to('/login','Following link') !!}
                </p>
        @endif
        </div>
    </div>
@stop
