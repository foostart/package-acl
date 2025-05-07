@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {{ trans($plang_admin.'.pages.user-list') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-9">
            {{-- print messages --}}
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            {{-- print errors --}}
            @if($errors && $errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            {{-- BODY --}}
            {{ html()->form('GET', route('users.delete'))->class('form-responsive')->open() }}
                @include('package-acl::admin.user.user-table')
                {{ csrf_field() }}
            {{ html()->form()->close() }}
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
