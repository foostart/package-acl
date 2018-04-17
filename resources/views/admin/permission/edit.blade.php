@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: edit permission
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}
        @if($errors->has('model') )
        <div class="alert alert-danger">{{$errors->first('model')}}</div>
        @endif

        {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{{$message}}</div>
        @endif
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">{!! isset($permission->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-lock"></i> Create' !!} permission</h3>
            </div>
            <div class="panel-body">
               {!! Form::model($permission, [ 'url' => [URL::route('permissions.edit'), $permission->id], 'method' => 'post'] )  !!}
               {!! Form::hidden('id') !!}
               <a href="{!! URL::route('permissions.delete',['id' => $permission->id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete">Delete</a>
               {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
               {!! Form::close() !!}
               <div class="row">
                <div class="col-md-6 col-xs-12">
                  <!-- DESCRIPTION TEXT FIELD -->
                  <div class="form-group">
                    {!! Form::label('description','Description: *') !!}
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'permission description', 'id' => 'slugme']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('description') !!}</span>

                <!-- PERMISSION TEXT FIELD -->
                <div class="form-group">
                    {!! Form::label('permission','Permission: *') !!}
                    {!! Form::text('permission', null, ['class' => 'form-control', 'placeholder' => 'permission description', 'id' => 'slug']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('permission') !!}</span>

                <!-- URL TEXT FIELD -->
                <div class="form-group">
                    {!! Form::label('url','Link URL: *') !!}
                    {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'link url']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('url') !!}</span>
            </div>
            <div class="col-md-6 col-xs-12">
                <!-- OVERVIEW TEXT FIELD -->
                <div class="form-group">
                    {!! Form::label('overview','Overview: ') !!}
                    {!! Form::text('overview', null, ['class' => 'form-control', 'placeholder' => 'overview']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('overview') !!}</span>

                <!-- category_id text field -->
                <div class="form-group">
                    {!! Form::label('category_id','Category: ') !!}
                    {!! Form::select('category_id', $pluck_select_category_department, null, ["class" => "form-control"]) !!}
                </div>
                <span class="text-danger">{!! $errors->first('category_id') !!}</span>
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
@stop

@section('footer_scripts')
{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/slugit.js') !!}
<script>
    $(".delete").click(function(){
        return confirm("Are you sure to delete this item?");
    });
    $(function(){
        $('#slugme').slugIt();
    });
</script>
@stop