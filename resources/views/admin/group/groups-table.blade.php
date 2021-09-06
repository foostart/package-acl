<?php
$withs = [
    'counter' => '5%',
    'id' => '7%',
    'name' => '30%',
    'permissions' => '50%',
    'status' => '8%',
];
?>

@if( ! $groups->isEmpty() )
    <div style="min-height: 50px;">
        <div>
            @if($groups->total() == 1)
                {!! trans($plang_admin.'.descriptions.counter', ['number' => 1]) !!}
            @else
                {!! trans($plang_admin.'.descriptions.counters', ['number' => $groups->total()]) !!}
            @endif
        </div>

        {!! Form::submit(trans($plang_admin.'.buttons.delete-in-trash'), array(
                                                                            "class"=>"btn btn-warning delete btn-delete-all",
                                                                            "title"=> trans($plang_admin.'.hint.delete-in-trash'),
                                                                            'name'=>'del-trash'))
        !!}
        {!! Form::submit(trans($plang_admin.'.buttons.delete-forever'), array(
                                                                    "class"=>"btn btn-danger delete btn-delete-all",
                                                                    "title"=> trans($plang_admin.'.hint.delete-forever'),
                                                                    'name'=>'del-forever'))
        !!}
    </div>

    <table class="table table-hover">
        <thead>
            <tr>

                <!-- COUNTER -->
                <?php $name = 'counter' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.labels.'.$name) !!}
                    <span class="del-checkbox pull-right">
                        <input type="checkbox" id="selecctall"/>
                    </span>
                </th>

                <!-- ID -->
                <?php $name = 'id' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.labels.'.$name) !!}
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-email' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!-- Group -->
                <?php $name = 'name' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.tables.group-'.$name) !!}
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-email' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!--Group permissions-->
                <?php $name = 'permissions' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.tables.group-'.$name) !!}
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-email' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!--STATUS-->
                <?php $name = 'status' ?>
                <th class="hidden-xs text-center" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.status') !!}
                </th>
            </tr>
        </thead>

        <tbody>

        <?php $counter = $groups->perPage() * ($groups->currentPage() - 1) + 1; ?>
        @foreach($groups as $group)

            <tr>
                <td>
                    <?php echo $counter; $counter++ ?>
                    <span class='box-item pull-right'>
                        <input type="checkbox" id="<?php echo $group->id ?>" name="ids[]"
                               value="{!! $group->id !!}">
                        <label for="box-item"></label>
                    </span>
                </td>
                <td>
                    <a href="{!! URL::route('groups.edit', ['id' => $group->id, '_token' => csrf_token()]) !!}">
                        {!! $group->id !!}
                    </a>

                    <span class="clearfix"></span>
                </td>
                <td style="width:40%">{!! $group->name !!}</td>

                <td style="width:50%">{!! $group->permissions !!}</td>

                <td class="text-center">
                    {!! $group->deleted_at ? '<i class="fa fa-circle-o red" title="In trash"></i>' :
                                            '<i class="fa fa-circle green" title="Available"></i>' !!}
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    <div class="paginator">
        {!! $groups->appends($request->except(['page']) )->render($pagination_view) !!}
    </div>
@else
    <span class="text-warning"><h5>No results found.</h5></span>
@endif
@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/js/form-table.js')  !!}
@stop
