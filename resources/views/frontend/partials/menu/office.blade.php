<ul>
  <li>
    <a href="{{ route('page.office.about') }}" class="{{ request()->routeIs('page.office.about') ? 'is-active' : '' }}">
      Über uns
    </a>
  </li>
  <li>
    <a href="{{ route('page.office.jobs') }}" class="{{ request()->routeIs('page.office.jobs') ? 'is-active' : '' }}">
      Jobs
    </a>
  </li>
</ul>