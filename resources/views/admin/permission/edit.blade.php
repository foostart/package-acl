@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.permission-edit') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-9">
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
                    <h3 class="panel-title bariol-thin">
                        {!! isset($permission->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-lock"></i> Create' !!}
                        permission
                    </h3>
                </div>
                <div class="panel-body">
                    {!! Form::model($permission, [ 'url' => [URL::route('permissions.edit'), $permission->id], 'method' => 'post'] )  !!}
                    {!! Form::hidden('id') !!}
                    <div clas="row">
                        <div class="col-md-12">
                            <a href="{!! URL::route('permissions.delete',['id' => $permission->id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">Delete</a>
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-6">
                            <!-- NAME TEXT FIELD -->
                            <div class="form-group">
                                {!! Form::label('name',trans($plang_admin.'.labels.permission_name').':*') !!}
                                {!! Form::text('name', @$permission->name, ['class' => 'form-control', 'placeholder' => 'Permission name', 'id' => 'slugme']) !!}
                            </div>
                            <span class="text-danger">{!! $errors->first('name') !!}</span>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <!-- PERMISSION TEXT FIELD -->
                            <div class="form-group">
                                {!! Form::label('permission',trans($plang_admin.'.labels.permission-name').':*') !!}
                                {!! Form::text('permission', @$permission->permission, ['class' => 'form-control', 'placeholder' => 'Permission slug', 'id' => 'slug']) !!}
                            </div>
                            <span class="text-danger">{!! $errors->first('permission') !!}</span>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <!-- category_id TEXT FIELD -->
                            <div class="form-group">
                                {!! Form::label('category_id',trans($plang_admin.'.labels.category').':') !!}
                                {!! Form::select('category_id', $pluck_select_category, @$permission->category_id, ["class" => "form-control"]) !!}
                            </div>
                            <span class="text-danger">{!! $errors->first('category_id') !!}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!--PERMISSION DESCRIPTION-->
                            @include('package-category::admin.partials.textarea', [
                            'name' => 'description',
                            'label' => trans($plang_admin.'.labels.permission_description'),
                            'value' => @$item->slideshow_description,
                            'description' => trans($plang_admin.'.descriptions.permission_description'),
                            'rows' => 50,
                            'tinymce' => true,
                            'errors' => $errors,
                            ])
                            <!--/PERMISSION DESCRIPTION-->
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('package-acl::admin.permission.search')
        </div>
    </div>
@stop

@section('footer_scripts')
    {!! HTML::script('packages/foostart/js/vendor/slugit.js') !!}
    <script>
        $(".delete").click(function () {
            return confirm("{!! trans($plang_admin.'.messages.user-delete') !!}");
        });
        $(function () {
            $('#slugme').slugIt();
        });
    </script>
@stop
