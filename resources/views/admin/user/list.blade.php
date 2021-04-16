@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.user-list') !!}
@stop
@section('content')
    <div class="row">
        <div class="col-md-9">
            {{-- print messages --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
            @endif
            {{-- print errors --}}
            @if($errors && ! $errors->isEmpty() )
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{!! $error !!}</div>
                @endforeach
            @endif
            {{-- user lists --}}
            @include('package-acl::admin.user.user-table')
        </div>
        <div class="col-md-3">
            @include('package-acl::admin.user.search')
        </div>
    </div>
@stop

@section('footer_scripts')
    <script>
        $(".delete").click(function () {
            return confirm("{!! trans($plang_admin.'.messages.user-delete') !!}");
        });
    </script>
@stop