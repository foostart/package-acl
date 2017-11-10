<div class="panel panel-info">
    <!--HEADING-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin">
            <i class="fa fa-user"></i>
            {!! $request->all() ? trans('jacopo-admin.users-search') : trans('jacopo-admin.users-list') !!}
        </h3>
    </div>

    <div class="panel-body">

        <!--TOP MENU-->
        <div class="row">
            <div class="col-lg-10 col-md-8 col-sm-8">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4">
                    <a href="{!! URL::route('users.edit') !!}" class="btn btn-info">
                        <i class="fa fa-plus"></i>
                        {!! trans('jacopo-admin.user-add-new') !!}
                    </a>
            </div>
        </div>

        <!--TABLE-->
        <div class="row">
            <div class="col-md-12">
                @if(! $users->isEmpty() )
                <table class="table table-hover">

                        <!--TITLE-->
                        <thead>
                            <tr>
                                <!-- ORDER -->
                                <th>{!! trans('jacopo-admin.order') !!}
                                    <a href='#' class='tb-order'>
                                    </a>
                                </th>

                                <!-- EMAIL -->
                                <?php $name = 'email' ?>
                                <th class="hidden-xs">{!! trans('jacopo-admin.'.$name) !!}
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
                                <th class="hidden-xs">{!! trans('jacopo-admin.'.$name) !!}
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
                                <th class="hidden-xs">{!! trans('jacopo-admin.'.$name) !!}
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
                                <th class="hidden-xs">{!! trans('jacopo-admin.'.$name) !!}
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

                                <!-- LAST LOGIN -->
                                <?php $name = 'last_login' ?>
                                <th class="hidden-xs">{!! trans('jacopo-admin.'.$name) !!}
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

                                <!-- OPERATION -->
                                <th>{!! trans('jacopo-admin.operations') !!}</th>
                            </tr>
                        </thead>

                        <!--DATA-->
                        <tbody>
                            <?php
                                $index = $users->perPage()*($users->currentPage() - 1) + 1;
                            ?>
                            @foreach($users as $user)
                            <tr>
                                <td><?php echo $index; $index++; ?></td>
                                <td>{!! $user->email !!}</td>
                                <td class="hidden-xs">{!! $user->first_name !!}</td>
                                <td class="hidden-xs">{!! $user->last_name !!}</td>
                                <td>{!! $user->activated ? '<i class="fa fa-circle green"></i>' : '<i class="fa fa-circle-o red"></i>' !!}</td>
                                <td class="hidden-xs">{!! $user->last_login ? $user->last_login : trans('jacopo-admin.message-last-login') !!}</td>
                                <td>
                                    @if(! $user->protected)
                                        <a href="{!! URL::route('users.edit', ['id' => $user->id]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                        <a href="{!! URL::route('users.delete',['id' => $user->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                    @else
                                        <i class="fa fa-times fa-2x light-blue"></i>
                                        <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                </table>
                <div class="paginator">
                    {!! $users->appends($request->except(['page']) )->render() !!}
                </div>
                @else
                <span class="text-warning"><h5>{!! trans('jacopo-admin.empty_data') !!}</h5></span>
                @endif
            </div>
        </div>
    </div>
</div>
