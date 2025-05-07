@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.group-edit') !!}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- model general errors from the form --}}
            @if($errors->has('model'))
                <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
            @endif

            {{-- successful message --}}
            <?php $message = Session::get('message'); ?>
            @if(isset($message))
                <div class="alert alert-success">{{$message}}</div>
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! isset($group->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-users"></i> Create' !!}
                        group
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-6">
                            {{-- group base form --}}
                            <h4>{!! trans($plang_admin.'.labels.general-data') !!}</h4>
                            {{ html()->form('POST', route('groups.editPost', ['group' => $group->id]))->open() }}
                                <!-- name text field -->
                                <div class="form-group">
                                    {{ html()->label(trans($plang_admin.'.labels.group-name').':*')->for('name') }}
                                    {{ html()->text('name')->class('form-control')->placeholder('group name')->value($group->name) }}
                                </div>
                                <span class="text-danger">{!! $errors->first('name') !!}</span>
                                {{ html()->hidden('id')->value($group->id) }}

                                @if($group->deleted_at)
                                    <a href="{{ route('groups.restore', ['id' => $group->id, '_token' => csrf_token()]) }}" class="btn btn-success pull-right margin-left-5 restore">
                                        {!! trans($plang_admin.'.buttons.restore') !!}
                                    </a>
                                @else
                                    <a href="{{ route('groups.delete', ['id' => $group->id, '_token' => csrf_token()]) }}" class="btn btn-warning pull-right margin-left-5 delete">
                                        {!! trans($plang_admin.'.buttons.delete') !!}
                                    </a>
                                @endif
                                {{ html()->submit(trans($plang_admin.'.buttons.save'))->class('btn btn-info pull-right') }}
                            {{ html()->form()->close() }}
                        </div>
                        <div class="col-md-4 col-xs-6"></div>
                        <div class="col-md-4 col-xs-6">
                            {{-- group permission form --}}
                            <h4><i class="fa fa-lock"></i>{!! trans($plang_admin.'.labels.permission-name') !!}</h4>
                            {{-- permissions --}}
                            @include('package-acl::admin.group.perm')
                        </div>
                    </div>
                </div>
            </div>
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
