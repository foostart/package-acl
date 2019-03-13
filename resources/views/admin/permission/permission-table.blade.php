@if( ! $permissions->isEmpty() )
    <table class="table table-hover">
        <thead>
        <tr>
            <!-- ORDER -->
            <?php $name = 'id' ?>
            <th width=10% class="hidden-xs">#
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

            <!-- Permission description -->
            <?php $name = 'description' ?>
            <th class="hidden-xs">{!! trans($plang_admin.'.tables.permission-'.$name) !!}
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

            <!-- Permission name -->
            <?php $name = 'permission' ?>
            <th class="hidden-xs">{!! trans($plang_admin.'.tables.'.$name.'-name') !!}
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

            <!-- URL -->
            <?php $name = 'url' ?>
            <th class="hidden-xs">{!! trans($plang_admin.'.tables.permission-'.$name) !!}
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

            <!-- OPERATION -->
            <th>{!! trans($plang_admin.'.menu.operations') !!}</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $index = $permissions->perPage() * ($permissions->currentPage() - 1) + 1;
            ?>
            @foreach($permissions as $permission)
            <tr>
                <td><?php echo $permission->id ?></td>
                <td style="width:30%">{!! $permission->description !!}</td>
                <td style="width:30%">{!! $permission->permission !!}</td>
                <td style="width:30%">{!! $permission->url !!}</td>
                <td style="witdh:10%">
                    @if(! $permission->protected)
                        <a href="{!! URL::route('permissions.edit', ['id' => $permission->id]) !!}">
                            <i class="fa fa-pencil-square-o fa-2x"></i>
                        </a>
                        <a href="{!! URL::route('permissions.delete',['id' => $permission->id, '_token' => csrf_token()]) !!}" class="margin-left-5">
                            <i class="fa fa-trash-o delete fa-2x"></i>
                        </a>
                    @else
                        <i class="fa fa-times fa-2x light-blue"></i>
                        <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginator">
    {!! $permissions->appends($request->except(['page']) )->render() !!}
    </div>
@else
<span class="text-warning"><h5>{!! trans($plang_admin.'.messages.permission-not-found') !!}</h5></span>
@endif