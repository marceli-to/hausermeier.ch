@extends('frontend.layout.app')
@section('seo_title', 'Kontakt')
@section('seo_description', 'Limmatstrasse 285, 8005 Zürich, +41 (0)44 273 29 22, mail@hausermeier.ch')
@section('content')
<header class="page-header">
  <h1>Kontakt</h1>
</header>
<section class="content-contact">
  <div class="grid-2x1">
    <div class="content-visual">
      <figure>
        <img data-src="/image/contact/{{$image->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$image->caption}}">
      </figure>
    </div>
    <div class="map">
      <div id="js-map"></div>
    </div>
    <div>
      <address>{!! $data->address !!}</address>
      <p class="hide-md">
        <a href="https://goo.gl/maps/myumDshKumjxoQAj9" target="_blank" rel="noopener" class="icon-arrow-up">Auf Google Maps anzeigen</a>
      </p>
      <p>
        <a href="javascript:;" class="icon-chevron js-btn-imprint js-logo-switch">Impressum</a>
      </p>
      <div class="imprint js-imprint" style="display: none">{!! $data->imprint !!}</div>
    </div>
    <div>
      <div class="hide-sm fs-sm">
        <a href="https://goo.gl/maps/myumDshKumjxoQAj9" target="_blank" rel="noopener" class="icon-arrow-up-sm fs-sm">Auf Google Maps anzeigen</a>
      </div>
    </div>
  </div>
</section>
@endsection