@extends('package-acl::client.layouts.base-fullscreen')
@section ('title')
    {!! trans($plang_front.'.pages.title-signup-email') !!}
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 text-center v-center">

        <h1>
            <i class="fa fa-download"></i>
            {!! trans($plang_front.'.messages.signup-email-heading') !!}
        </h1>
        <p class="lead">
            {!! trans($plang_front.'.messages.signup-email-info') !!}
        </p>
    </div>
</div>
@stop
