@extends('frontend.layout.app')
@section('seo_title', 'Home')
@section('seo_description', 'Hauser Meier Architektinnen GmbH, Architekturbüro ETH SIA Zürich')
@section('content')
<section class="content-home">
  @if ($grids)
    <div class="home-grid">
      <div class="ratio-boxes is-home">
        @foreach($grids as $g)
          @if ($g['key'] == '1')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '1-1')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '1-2')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '2-1')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '1-1-1')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '1-1-2s')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '1-2s-1')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '2s-1-1')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '1p-1p-1p')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '2s-1')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
          @if ($g['key'] == '1-2s')
            @if (isset($g['elements']))
              @include('frontend.partials.boxes.home.' . $g['key'], array('elements' => $g['elements']))
            @endif
          @endif
        @endforeach
      </div>
    </div>
  @endif
</section>
@endsection