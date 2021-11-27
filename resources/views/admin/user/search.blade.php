<div class="panel panel-info">
    <!-- HEADING -->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin">
            <i class="fa fa-search"></i>{!! trans($plang_admin.'.search.user') !!}
        </h3>
    </div>

    <!-- BODY -->
    <div class="panel-body">
        {!! Form::open(['route' => 'users.list','method' => 'get']) !!}
        <div class="form-group">
            <a href="{!! URL::route('users.list') !!}"
               class="btn btn-default search-reset">{!! trans($plang_admin.'.buttons.reset') !!}</a>
            {!! Form::submit(trans($plang_admin.'.search.btn-submit'), ["class" => "btn btn-info", "id" => "search-submit"]) !!}
        </div>

        <!-- KEYWORD -->
        @include('package-category::admin.partials.input_text', [
            'name' => 'keyword',
            'placehover' => trans($plang_admin.'.labels.keyword'),
            'label' => trans($plang_admin.'.labels.keyword'),
            'value' => @$params['keyword'],
        ])
        <span class="text-danger">{!! $errors->first('keyword') !!}</span>

        <button type="button" class="btn btn-info" data-toggle="collapse"
                data-target="#more_filter">{!! trans($plang_admin.'.search.btn-advance') !!}</button>

        <div id='more_filter' class='collapse'>

            <!-- EMAIL -->
            @include('package-category::admin.partials.input_text', [
                'name' => 'email',
                'placehover' => trans($plang_admin.'.labels.email'),
                'label' => trans($plang_admin.'.labels.email'),
                'value' => @$params['email'],
            ])
            <span class="text-danger">{!! $errors->first('email') !!}</span>

            <!-- FULL NAME-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'full_name',
                'placehover' => trans($plang_admin.'.labels.full_name'),
                'label' => trans($plang_admin.'.labels.full_name'),
                'value' => @$params['full_name'],
            ])
            <span class="text-danger">{!! $errors->first('full_name') !!}</span>

            <!-- FIRST NAME -->
            @include('package-category::admin.partials.input_text', [
                'name' => 'first_name',
                'placehover' => trans($plang_admin.'.labels.first_name'),
                'label' => trans($plang_admin.'.labels.first_name'),
                'value' => @$params['first_name'],
            ])
            <span class="text-danger">{!! $errors->first('first_name') !!}</span>

            <!-- LAST NAME -->
            @include('package-category::admin.partials.input_text', [
                'name' => 'last_name',
                'placehover' => trans($plang_admin.'.labels.last_name'),
                'label' => trans($plang_admin.'.labels.last_name'),
                'value' => @$params['last_name'],
            ])
            <span class="text-danger">{!! $errors->first('last_name') !!}</span>

            <!-- SEX -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'sex',
                'label' => trans($plang_admin.'.labels.sex'),
                'value' => @$params['sex'],
                'items' => trans($plang_admin . '.sex'),
            ])
            <span class="text-danger">{!! $errors->first('sex') !!}</span>

            <!-- CATEGORY -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'category_id',
                'label' => trans($plang_admin.'.labels.category'),
                'value' => @$params['category_id'],
                'items' => $pluck_select_category_department,
            ])
            <span class="text-danger">{!! $errors->first('category_id') !!}</span>

            <!-- ACTIVE -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'activated',
                'label' => trans($plang_admin.'.labels.active'),
                'value' => @$params['activated'],
                'items' => trans($plang_admin . '.active'),
            ])

            <!--BANNED-->
            @include('package-category::admin.partials.select_single', [
                'name' => 'banned',
                'label' => trans($plang_admin.'.labels.banned'),
                'value' => @$params['banned'],
                'items' => trans($plang_admin . '.banned'),
            ])

            <!--GROUP-->
            <?php
                $group_values = ['' => trans($plang_admin . '.form.any')] + $group_values;
            ?>
            @include('package-category::admin.partials.select_single', [
                'name' => 'group_id',
                'label' => trans($plang_admin.'.labels.group'),
                'value' => @$params['group_id'],
                'items' => $group_values
            ])

            <!--SORTING-->
            @include('package-category::admin.partials.sorting')

        </div>
        {!! Form::close() !!}
    </div>
</div>

@section('footer_scripts')
    @parent
@stop
