@extends('package-acl::admin.layouts.base-2cols')

@section('title')
{!! trans($plang_admin.'.pages.group-edit') !!}
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}
        @if($errors->has('model') )
        <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
        @endif

        {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{{$message}}</div>
        @endif
        <div class="panel panel-info">
            <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">{!! isset($group->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-users"></i> Create' !!} group</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        {{-- group base form --}}
                        <h4>{!! trans($plang_admin.'.labels.general-data') !!}</h4>
                        {!! Form::model($group, [ 'url' => [URL::route('groups.edit'), $group->id], 'method' => 'post'] ) !!}
                        <!-- name text field -->
                        <div class="form-group">
                            {!! Form::label('name',trans($plang_admin.'.labels.group-name').':*') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'group name']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('name') !!}</span>
                        {!! Form::hidden('id') !!}
                        <a href="{!! URL::route('groups.delete',['id' => $group->id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete">Delete</a>
                        {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6 col-xs-12">
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
    $(".delete").click(function(){
        return confirm("{!! trans($plang_admin.'.messages.user-delete') !!}");
    });
</script>
@stop