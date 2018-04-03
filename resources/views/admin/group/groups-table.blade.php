<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('groups.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New</a>
    </div>
</div>
@if( ! $groups->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>

            <!-- ORDER -->
            <th>{!! trans('jacopo-admin.order') !!}
                <a href='#' class='tb-order'>
                </a>
            </th>

            <!-- Group name -->
            <?php $name = 'name' ?>
            <th class="hidden-xs">{!! trans('jacopo-admin.group-'.$name) !!}
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

            <!-- OPERATION -->
            <th>{!! trans('jacopo-admin.operations') !!}</th>

        </tr>
    </thead>
    <tbody>
        <?php
            $index = $groups->perPage() * ($groups->currentPage() - 1) + 1;
        ?>
        @foreach($groups as $group)

        <tr>
            <td><?php echo $index; $index++; ?></td>
            <td style="width:40%">{!! $group->name !!}</td>

            <td style="width:50%">{!! $group->permissions !!}</td>

            <td style="width:10%">
            @if(! $group->protected)
                <a href="{!! URL::route('groups.edit', ['id' => $group->id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('groups.delete',['id' => $group->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
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
    {!! $groups->appends($request->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif