<?php
    $withs = [
        'counter' => '5%',
        'id' => '7%',
        'email' => '30%',
        'first_name' => '15%',
        'last_name' => '15%',
        'active' => '10%',
        'status' => '5%',
        'last_login' => '13%',
    ];
?>
<div class="panel panel-info">
    <!--HEADING-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin">
            <i class="fa fa-user"></i>
            {!! $request->all() ? trans($plang_admin.'.search.user') : trans($plang_admin.'.sidebars.users-list') !!}
        </h3>
    </div>

    <div class="panel-body">

        <!--TABLE-->
        <div class="row">
            <div class="col-md-12">
                @if(! $users->isEmpty() )
                    <div class="table-responsive">

                        <div style="min-height: 50px;">
                            <div>
                                @if($users->total() == 1)
                                    {!! trans($plang_admin.'.descriptions.counter', ['number' => 1]) !!}
                                @else
                                    {!! trans($plang_admin.'.descriptions.counters', ['number' => $users->total()]) !!}
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

                            <!--TITLE-->
                            <thead>
                            <tr>
                                <!-- COUNTER -->
                                <?php $name = 'counter' ?>
                                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                                    {!! trans($plang_admin.'.labels.'.$name) !!}
                                    <span class="del-checkbox pull-right">
                                        <input type="checkbox" id="selecctall"/>
                                        <label for="del-checkbox"></label>
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

                                <!-- EMAIL -->
                                <?php $name = 'email' ?>
                                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                                    {!! trans($plang_admin.'.labels.'.$name) !!}
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

                                <!-- FIRST NAME -->
                                <?php $name = 'first_name' ?>
                                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                                    {!! trans($plang_admin.'.labels.'.$name) !!}
                                    <a href='{!! $sorting["url"][$name] !!}' class='tb-first-name' data-order='asc'>
                                        @if($sorting['items'][$name] == 'asc')
                                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                                        @elseif($sorting['items'][$name] == 'desc')
                                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                </th>

                                <!-- LAST NAME -->
                                <?php $name = 'last_name' ?>
                                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                                    {!! trans($plang_admin.'.labels.'.$name) !!}
                                    <a href='{!! $sorting["url"][$name] !!}' class='tb-last-name' data-order='asc'>
                                        @if($sorting['items'][$name] == 'asc')
                                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                                        @elseif($sorting['items'][$name] == 'desc')
                                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                </th>

                                <!-- ACTIVE -->
                                <?php $name = 'active' ?>
                                <th class="hidden-xs text-center" style='width:{{ $withs[$name] }}'>
                                    {!! trans($plang_admin.'.labels.'.$name) !!}
                                    <a href='{!! $sorting["url"][$name] !!}' class='tb-active' data-order='asc'>
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

                                <!-- LAST LOGIN -->
                                <?php $name = 'last_login' ?>
                                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                                    {!! trans($plang_admin.'.labels.'.$name) !!}
                                    <a href='{!! $sorting["url"][$name] !!}' class='tb-last-login' data-order='asc'>
                                        @if($sorting['items'][$name] == 'asc')
                                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                                        @elseif($sorting['items'][$name] == 'desc')
                                            <i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                </th>
                            </tr>
                            </thead>

                            <!--DATA-->
                            <tbody>
                            <?php $order = $users->perPage() * ($users->currentPage() - 1) + 1; ?>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <?php echo $order; $order++ ?>
                                        <span class='box-item pull-right'>
                                            <input type="checkbox" id="<?php echo $user->id ?>" name="ids[]" value="{!! $user->id !!}">
                                            <label for="box-item"></label>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{!! URL::route('users.edit', ['id' => $user->id]) !!}">
                                            {!! $user->id !!}
                                        </a>
                                    </td>
                                    <td>{!! $user->email !!}</td>
                                    <td class="hidden-xs">{!! $user->first_name !!}</td>
                                    <td class="hidden-xs">{!! $user->last_name !!}</td>
                                    <td class="text-center">
                                        {!! $user->activated ? '<i class="fa fa-circle green"></i>' : '<i class="fa fa-circle-o red"></i>' !!}
                                    </td>
                                    <td class="text-center">
                                        {!! $user->deleted_at ? '<i class="fa fa-circle-o red" title="In trash"></i>' :
                                                                '<i class="fa fa-circle green" title="Available"></i>' !!}
                                    </td>
                                    <td class="hidden-xs">
                                        {!! $user->last_login ? $user->last_login : trans($plang_admin.'.messages.message-last-login') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="paginator">
                        {!! $users->appends($request->except(['page']) )->render($pagination_view) !!}
                    </div>
                @else
                    <span class="text-warning"><h5>{!! trans($plang_admin.'.messages.empty-data') !!}</h5></span>
                @endif
            </div>
        </div>
    </div>
</div>
@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/js/form-table.js')  !!}
@stop
