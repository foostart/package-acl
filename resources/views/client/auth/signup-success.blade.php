@extends('package-acl::client.layouts.base-fullscreen')
@section ('title')
    {!! trans($plang_front.'.messages.signup-success-heading') !!}
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 text-center v-center">

        <h1>
            <i class="fa fa-thumbs-up"></i>
            {!! trans($plang_front.'.messages.signup-success-heading') !!} {!! Config::get('acl_base.app_name') !!}
        </h1>
        <p class="lead">
            {!! trans($plang_front.'.messages.signup-success-info') !!}
            {!! link_to('/login','Following link') !!}
        </p>
    </div>
</div>
@stop
