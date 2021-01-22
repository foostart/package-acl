<?php 
   $breadcrumb_1 = empty($breadcrumb_1)?NULL:$breadcrumb_1;
   $breadcrumb_2 = empty($breadcrumb_2)?NULL:$breadcrumb_2;
   $breadcrumb_3 = empty($breadcrumb_3)?NULL:$breadcrumb_3;
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      @if(!empty($breadcrumb_1))
      <li class="breadcrumb-item"><a href="{!! $breadcrumb_1['url'] !!}">{!! $breadcrumb_1['label'] !!}</a></li>
      @endif
      @if(!empty($breadcrumb_2))
      <li class="breadcrumb-item"><a href="{!! $breadcrumb_2['url'] !!}">{!! $breadcrumb_2['label'] !!}</a></li>
      @endif
      @if(!empty($breadcrumb_3))
        <li class="breadcrumb-item"><a href="{!! $breadcrumb_3['url'] !!}">{!! $breadcrumb_3['label'] !!}</a></li>
      @endif
  </ol>
</nav>
