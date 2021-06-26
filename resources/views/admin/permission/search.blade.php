<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i> Permission search</h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'permissions.list','method' => 'get']) !!}
        <div class="form-group">
            <a href="{!! URL::route('permissions.list') !!}" class="btn btn-default search-reset">{!! trans($plang_admin.'.buttons.reset') !!}</a>
            {!! Form::submit(trans($plang_admin.'.buttons.submit'), ["class" => "btn btn-info", "id" => "search-submit"]) !!}
        </div>
        <!-- name text field -->
        <div class="form-group">
            {!! Form::label('description',trans($plang_admin.'.labels.permission-name')) !!}
            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'permission name']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('description') !!}</span>

        <!-- category_id text field -->
        <div class="form-group">
            {!! Form::label('category_id',trans($plang_admin.'.labels.category')) !!}
            {!! Form::select('category_id', $pluck_select_category, null, ["class" => "form-control"]) !!}
        </div>
        <span class="text-danger">{!! $errors->first('category_id') !!}</span>

        @include('package-category::admin.partials.sorting')
        {!! Form::close() !!}
    </div>
</div>
