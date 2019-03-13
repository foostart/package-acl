<div class="panel panel-info">
    <!--HEADING-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin">
            <i class="fa fa-user"></i>
            {!! $request->all() ? trans($plang_admin.'.users-search') : trans($plang_admin.'.sidebars.users-list') !!}
        </h3>
    </div>

    <div class="panel-body">

        <!--TOP MENU-->
        <div class="row">
            <div class="col-lg-10 col-md-8 col-sm-8">
            </div>

        </div>

        <!--TABLE-->
        <div class="row">
            <div class="col-md-12">
                @if(! $users->isEmpty() )
                <div class="table-responsive">
                    <table class="table table-hover">

                        <!--TITLE-->
                        <thead>
                            <tr>
                                <!-- ORDER -->
                                <?php $name = 'id' ?>
                                <th  class="hidden-xs">#
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
                                <th class="hidden-xs">{!! trans($plang_admin.'.labels.'.$name) !!}
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
                                <th class="hidden-xs">{!! trans($plang_admin.'.labels.'.$name) !!}
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
                                <th class="hidden-xs">{!! trans($plang_admin.'.labels.'.$name) !!}
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
                                <th class="hidden-xs">{!! trans($plang_admin.'.labels.'.$name) !!}
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
                                <th class="hidden-xs">{!! trans($plang_admin.'.labels.'.$name) !!}
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
                                <th>{!! trans($plang_admin.'.menu.operations') !!}</th>
                            </tr>
                        </thead>

                        <!--DATA-->
                        <tbody>
                            <?php
                            $index = $users->perPage() * ($users->currentPage() - 1) + 1;
                            ?>
                            @foreach($users as $user)
                            <tr>
                                <td>{!! $user->id !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td class="hidden-xs">{!! $user->first_name !!}</td>
                                <td class="hidden-xs">{!! $user->last_name !!}</td>
                                <td>{!! $user->activated ? '<i class="fa fa-circle green"></i>' : '<i class="fa fa-circle-o red"></i>' !!}</td>
                                <td class="hidden-xs">{!! $user->last_login ? $user->last_login : trans($plang_admin.'.messages.message-last-login') !!}</td>
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
                </div>
                <div class="paginator">
                    {!! $users->appends($request->except(['page']) )->render() !!}
                </div>
                @else
                <span class="text-warning"><h5>{!! trans($plang_admin.'.messages.empty-data') !!}</h5></span>
                @endif
            </div>
        </div>
    </div>
</div>
