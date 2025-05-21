@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.permission-edit') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-9">

            @if($errors->has('model') )
                <div class="alert alert-danger">
                    {{$errors->first('model')}}
                </div>
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

                    <!-- FORM OPEN -->
                    @include('package-category::admin.partials.form_open', [
                        'method' => 'POST',
                        'action' => route('permissions.editPost', $permission->id)
                    ])
                    @include('package-category::admin.partials.input_text', [
                        'hidden' => true,
                        'name'   => 'id',
                        'id'     => 'id',
                    ])
                    <div clas="row">
                        <div class="col-md-12">
                            <a href="{!! URL::route('permissions.delete',['id' => $permission->id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">Delete</a>
                            {!! html->submit('Save')->class('btn btn-info pull-right') !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-6">
                            <!-- NAME TEXT FIELD -->
                            <div class="form-group">
                                @include('package-category::admin.partials.input_text', [
                                    'label'      => trans($plang_admin.'.labels.permission_name') . ':*',
                                    'name'       => 'name',
                                    'id'         => 'slugme',
                                    'value'      => old('name', @$permission->name),
                                    'class'      => 'form-control',
                                    'placeholder'=> 'Permission name'
                                ])


                            </div>
                            <span class="text-danger">{!! $errors->first('name') !!}</span>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <!-- PERMISSION TEXT FIELD -->
                            <div class="form-group">
                                @include('package-category::admin.partials.input_text', [
                                    'label'       => trans($plang_admin.'.labels.permission-name') . ':*',
                                    'name'        => 'permission',
                                    'id'          => 'slug',
                                    'value'       => old('permission', @$permission->permission),
                                    'class'       => 'form-control',
                                    'placeholder' => 'Permission slug'
                                ])

                            </div>
                            <span class="text-danger">{!! $errors->first('permission') !!}</span>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <!-- category_id TEXT FIELD -->
                            <div class="form-group">
                                @include('package-category::admin.partials.select_single', [
                                    'name' => 'category_id',
                                    'label' => trans($plang_admin.'.labels.category'),
                                    'value' => @$permission->category_id,
                                    'items' => $pluck_select_category,
                                    'class' => 'form-control',
                                ])

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
                    <!-- FORM CLOSE -->
                    @include('package-category::admin.partials.form_close')
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('package-acl::admin.permission.search')
        </div>
    </div>
@stop

@section('footer_scripts')
    <script src="{{ asset('packages/foostart/js/vendor/slugit.js') }}"></script>
    <script>
        $(".delete").click(function () {
            return confirm("{!! trans($plang_admin.'.messages.user-delete') !!}");
        });
        $(function () {
            $('#slugme').slugIt();
        });
    </script>
@stop
