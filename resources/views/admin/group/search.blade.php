<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i> Group search</h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'groups.list','method' => 'get']) !!}
        <div class="form-group">
            <a href="{!! URL::route('groups.list') !!}" class="btn btn-default search-reset">{!! trans($plang_admin.'.buttons.reset') !!}</a>
            {!! Form::submit(trans($plang_admin.'.buttons.submit'), ["class" => "btn btn-info", "id" => "search-submit"]) !!}
        </div>
        <!-- name text field -->
        <div class="form-group">
            {!! Form::label('name',trans($plang_admin.'.labels.group')) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'group name']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('name') !!}</span>
        @include('package-category::admin.partials.sorting')
        {!! Form::close() !!}
    </div>
</div>
