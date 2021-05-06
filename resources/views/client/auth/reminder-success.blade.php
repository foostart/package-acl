@extends('package-acl::client.layouts.base-fullscreen')
@section ('title')
    {!! trans($plang_front.'.pages.title-password-recovery') !!}
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 text-center v-center">

        <h1>
            <i class="fa fa-download"></i>
            {!! trans($plang_front.'.messages.reminder-heading') !!}
        </h1>
        <p class="lead">
            {!! trans($plang_front.'.messages.reminder-sent') !!}
        </p>
    </div>
</div>
@stop
