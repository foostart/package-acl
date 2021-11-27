@if(!empty($breadcrumbs))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item"><a href="{!! $breadcrumb['url'] !!}">{!! $breadcrumb['label'] !!}</a></li>
            @endforeach
        </ol>
    </nav>
@endif
