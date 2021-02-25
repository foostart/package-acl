@extends('package-acl::admin.layouts.base-2cols')

@section('title')
{!! trans($plang_admin.'.pages.permission-edit') !!}
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

               <div class="row">
                <div class="col-md-6 col-xs-12">
                  <!-- DESCRIPTION TEXT FIELD -->
                  <div class="form-group">
                    {!! Form::label('description',trans($plang_admin.'.labels.description').':*') !!}
                    {!! Form::text('description', @$permission->description, ['class' => 'form-control', 'placeholder' => 'permission description', 'id' => 'slugme']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('description') !!}</span>

                <!-- PERMISSION TEXT FIELD -->
                <div class="form-group">
                    {!! Form::label('permission',trans($plang_admin.'.labels.permission-name').':*') !!}
                    {!! Form::text('permission', @$permission->permission, ['class' => 'form-control', 'placeholder' => 'permission description', 'id' => 'slug']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('permission') !!}</span>

                <!-- URL TEXT FIELD -->
                <div class="form-group">
                    {!! Form::label('url',trans($plang_admin.'.labels.link-url').':*') !!}
                    {!! Form::text('url', @$permission->url, ['class' => 'form-control', 'placeholder' => 'link url']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('url') !!}</span>
            </div>
            <div class="col-md-6 col-xs-12">
                <!-- OVERVIEW TEXT FIELD -->
                <div class="form-group">
                    {!! Form::label('overview',trans($plang_admin.'.labels.overview').':') !!}
                    {!! Form::text('overview', @$permission->overview, ['class' => 'form-control', 'placeholder' => 'overview']) !!}
                </div>
                <span class="text-danger">{!! $errors->first('overview') !!}</span>

                <!-- category_id text field -->
                <div class="form-group">
                    {!! Form::label('category_id',trans($plang_admin.'.labels.category').':') !!}
                    {!! Form::select('category_id', $pluck_select_category, @$permission->category_id, ["class" => "form-control"]) !!}
                </div>
                <span class="text-danger">{!! $errors->first('category_id') !!}</span>
            </div>
        </div>
               {!! Form::close() !!}
    </div>
</div>
</div>
</div>
@stop

@section('footer_scripts')
{!! HTML::script('packages/foostart/js/vendor/slugit.js') !!}
<script>
    $(".delete").click(function(){
        return confirm("{!! trans($plang_admin.'.messages.user-delete') !!}");
    });
    $(function(){
        $('#slugme').slugIt();
    });
</script>
@stop