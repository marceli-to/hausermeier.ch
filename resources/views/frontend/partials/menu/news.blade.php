<ul>
  <li>
    <a href="{{ route('page.news.index') }}" class="{{ request()->routeIs('page.news.index') ? 'is-active' : '' }}">
      Alle
    </a>
  </li>
  <li>
    <a href="{{ route('page.news.discourse') }}" class="{{ request()->routeIs('page.news.discourse') ? 'is-active' : '' }}">
      Diskurs
    </a>
  </li>
  <li>
    <a href="{{ route('page.news.publications') }}" class="{{ request()->routeIs('page.news.publications') ? 'is-active' : '' }}">
      Publikationen
    </a>
  </li>
</ul>