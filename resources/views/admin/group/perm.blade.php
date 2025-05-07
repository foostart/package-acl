@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.group-list') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-9">
            {{-- Print messages --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
            @endif
            {{-- Print errors --}}
            @if($errors && ! $errors->isEmpty() )
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{!! $error !!}</div>
                @endforeach
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! $request->all() ? 'Search results:' : 'Groups' !!}</h3>
                </div>
                <div class="panel-body">
                    {{ html()->form('GET', route('groups.edit.permission'))
                        ->class('form-add-perm') }}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon form-button button-add-perm"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
                                {{ html()->select('permissions', $permission_values, '')->class('form-control permission-select') }}
                            </div>
                            <span class="text-danger">{{ $errors->first('permissions') }}</span>
                            {{ html()->hidden('id', $group->id) }}
                            {{ html()->hidden('operation', 1) }}
                        </div>
                    {{ html()->form()->close() }}

                    @if( $presenter->permissions )
                        @foreach($presenter->permissions_obj as $permission)
                            @if($permission)
                                {{ html()->form('GET', route('groups.edit.permission'))
                                    ->class('form-add-perm')
                                    ->name($permission->permission) }}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon form-button button-del-perm" name="{{ $permission->permission }}"><span class="glyphicon glyphicon-minus-sign add-input"></span></span>
                                            {{ html()->text('permission_desc', $permission->name)
                                                ->class('form-control')
                                                ->readonly() }}
                                            {{ html()->hidden('permissions', $permission->permission) }}
                                            {{ html()->hidden('id', $group->id) }}
                                            {{ html()->hidden('operation', 0) }}
                                        </div>
                                    </div>
                                {{ html()->form()->close() }}
                            @endif
                        @endforeach
                    @elseif($group->exists)
                        <span class="text-warning"><h5>There is no permission associated to the group.</h5></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer_scripts')
    <script>
        $(".button-add-perm").click(function () {
            <?php if($group->exists): ?>
            $('.form-add-perm').submit();
            <?php endif; ?>
        });
        $(".button-del-perm").click(function () {
            name = $(this).attr('name');
            $('form[name=' + name + ']').submit();
        });
    </script>
@stop
