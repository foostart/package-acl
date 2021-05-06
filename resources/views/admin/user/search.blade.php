<div class="panel panel-info">
    <!--Heading-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin">
            <i class="fa fa-search"></i>{!! trans($plang_admin.'.search.user') !!}
        </h3>
    </div>

    <div class="panel-body">
        {!! Form::open(['route' => 'users.list','method' => 'get']) !!}
        <div class="form-group">
            <a href="{!! URL::route('users.list') !!}" class="btn btn-default search-reset">{!! trans($plang_admin.'.buttons.reset') !!}</a>
            {!! Form::submit(trans($plang_admin.'.search.btn-submit'), ["class" => "btn btn-info", "id" => "search-submit"]) !!}
        </div>

        <!--MAIN FILTERS-->
            <!-- email text field -->
            <div class="form-group">
                {!! Form::label('email',trans($plang_admin.'.labels.email')) !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'user email']) !!}
            </div>
            <span class="text-danger">{!! $errors->first('email') !!}</span>

            <!-- full name text field-->
            <div class="form-group">
                {!! Form::label('full_name',trans($plang_admin.'.labels.full_name')) !!}
                {!! Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'full name']) !!}
            </div>
            <span class="text-danger">{!! $errors->first('full_name') !!}</span>

        <!--/END MAIN FILTERS-->

        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#more_filter">{!! trans($plang_admin.'.search.btn-advance') !!}</button>

        <div id='more_filter' class='collapse'>

            <!-- first_name text field -->
            <div class="form-group">
                {!! Form::label('first_name',trans($plang_admin.'.labels.first_name')) !!}
                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'first name']) !!}
            </div>
            <span class="text-danger">{!! $errors->first('first_name') !!}</span>

            <!-- last_name text field -->
            <div class="form-group">
                {!! Form::label('last_name',trans($plang_admin.'.labels.last_name')) !!}
                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'last name']) !!}
            </div>
            <span class="text-danger">{!! $errors->first('last_name') !!}</span>

            <!-- sex text field -->
            <div class="form-group">
                {!! Form::label('sex',trans($plang_admin.'.labels.sex')) !!}
                <?php $sex_values = trans($plang_admin.'.sex');?>
                {!! Form::select('sex', $sex_values, $request->get('sex',''), ["class" => "form-control"]) !!}
            </div>
            <span class="text-danger">{!! $errors->first('sex') !!}</span>

            <!-- category_id text field -->
            <div class="form-group">
                {!! Form::label('category_id',trans($plang_admin.'.labels.category')) !!}
                {!! Form::select('category_id', $pluck_select_category_department, '', ["class" => "form-control"]) !!}
            </div>
            <span class="text-danger">{!! $errors->first('category_id') !!}</span>

            <!-- code text field -->
            <div class="form-group">
                {!! Form::label('code',trans($plang_admin.'.labels.code')) !!}
                    {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'user code']) !!}
            </div>
            <span class="text-danger">{!! $errors->first('code') !!}</span>

            <!--active select field-->
            <div class="form-group">
                {!! Form::label('activated', trans($plang_admin.'.labels.active')) !!}
                {!! Form::select('activated', ['' => 'Any', 1 => 'Yes', 0 => 'No'], $request->get('activated',''), ["class" => "form-control"]) !!}
            </div>

            <!--banned select field-->
            <div class="form-group">
                <?php $banned = trans($plang_admin.'.banned'); ?>
                {!! Form::label('banned', 'Banned: ') !!}
                {!! Form::select('banned', $banned, $request->get('banned',''), ["class" => "form-control"]) !!}
            </div>

            <!--group select field-->
            <div class="form-group">
                {!! Form::label('group_id', trans($plang_admin.'.labels.group')) !!}
                <?php
                    $group_values = [''=> trans($plang_admin.'.form.any')] + $group_values;
                    ?>
                {!! Form::select('group_id', $group_values, $request->get('group_id',''), ["class" => "form-control"]) !!}
            </div>

            <!--SORTING-->
            @include('package-category::admin.partials.sorting')
        </div>
        {!! Form::close() !!}
    </div>
</div>

@section('footer_scripts')
    @parent
@stop
