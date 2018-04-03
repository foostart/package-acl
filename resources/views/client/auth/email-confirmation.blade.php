@extends('laravel-authentication-acl::client.layouts.base-fullscreen')
@section ('title')
Registration completed
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 text-center v-center">
        @if($errors->has('token'))
            <h1><i class="fa fa-bolt"></i> Oops, something went wrong: the token is invalid</h1>
        @elseif($errors->has('email'))
            <h1><i class="fa fa-bolt"></i> Oops, something went wrong: the email is invalid</h1>
        @else
                <h1><i class="fa fa-thumbs-up"></i> Congratulations, you successfully registered to
                    {!! Config::get('acl_base.app_name') !!}</h1>
                <p class="lead">Your email has been confirmed.
                    Now you can login to the website using the {!! link_to('/login','Following link') !!}</p>
        @endif
        </div>
    </div>
@stop