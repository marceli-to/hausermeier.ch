<ul>
  <li>
    <a href="{{ route('page.works.year') }}" class="{{ request()->routeIs('page.works.year') ? 'is-active' : '' }}">
      Jahr
    </a>
  </li>
  <li>
    <a href="{{ route('page.works.topic') }}" class="{{ request()->routeIs('page.works.topic') ? 'is-active' : '' }}">
      Thema
    </a>
  </li>
</ul>
<ul class="filter">
  <li data-type="images">
    <a href="javascript:;" class="is-active js-btn-works js-logo-switch">Bilder</a>
  </li>
  <li data-type="list">
    <a href="javascript:;" class="js-btn-works js-logo-switch">Liste</a>
  </li>
</ul>