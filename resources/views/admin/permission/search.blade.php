<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i> Permission search</h3>
    </div>
    <div class="panel-body">
        {{ html()->form('GET', route('permissions.list')) }}
        <div class="form-group">
            <a href="{{ route('permissions.list') }}" class="btn btn-default search-reset">
                {!! trans($plang_admin.'.buttons.reset') !!}
            </a>
            {{ html()->submit(trans($plang_admin.'.buttons.submit'))
                ->class('btn btn-info')
                ->id('search-submit')
            }}
        </div>

        <!-- KEYWORD -->
        @include('package-category::admin.partials.input_text', [
            'name' => 'keyword',
            'label' => trans($plang_admin.'.form.keyword'),
            'value' => @$params['keyword'],
        ])

        <!-- category_id text field -->
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.category'))->for('category_id') }}
            {{ html()->select('category_id', $pluck_select_category)->class('form-control') }}
        </div>
        <span class="text-danger">{{ $errors->first('category_id') }}</span>

        @include('package-category::admin.partials.sorting')
        {{ html()->form()->close() }}
    </div>
</div>
