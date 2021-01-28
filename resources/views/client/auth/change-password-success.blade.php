@extends('package-acl::client.layouts.base-fullscreen')
@section ('title')
{!! trans($plang_front.'.pages.change-password-success-title') !!}
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 text-center v-center">

        <h1><i class="fa fa-thumbs-up"></i>
            {!! trans($plang_front.'.messages.change-password-success') !!}
        </h1>
        <p class="lead">
            {!! trans($plang_front.'.messages.try-again') !!}
            <a href="{!! URL::to('/login') !!}"><i class="fa fa-home"></i>
                {!! trans($plang_front.'.pages.home-page') !!}
            </a>
        </p>
    </div>
</div>
@stop