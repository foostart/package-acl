@extends('laravel-authentication-acl::client.layouts.base-fullscreen')
@section ('title')
{!! trans('jacopo-front.change-password-success-title' !!}
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 text-center v-center">

        <h1><i class="fa fa-thumbs-up"></i>
            {!! trans('jacopo-front.change-password-success-title' !!}
        </h1>
        <p class="lead">
            {!! trans('jacopo-front.change-password-success-message' !!}
            <a href="{!! URL::to('/') !!}"><i class="fa fa-home"></i>
                {!! trans('jacopo-front.home-page' !!}
            </a>
        </p>
    </div>
</div>
@stop