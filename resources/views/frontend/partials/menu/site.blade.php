<nav class="site-menu js-menu">
  <div>
    <div class="site-menu__main js-menu-main">
      <ul>
        <li>
          <a href="javascript:;" class="{{ request()->routeIs('page.project*') ? 'is-active' : '' }} js-menu-parent" data-menu-parent="projects">
            Projekte
          </a>
        </li>
        <li>
          <a href="{{ route('page.works.year') }}" class="{{ request()->routeIs('page.works*') ? 'is-active' : '' }}">
            Werkliste
          </a>
        </li>
        <li>
          <a href="{{ route('page.interaction.index') }}" class="{{ request()->routeIs('page.interaction*') ? 'is-active' : '' }}">
            Interaktionen
          </a>
        </li>
      </ul>
      <ul>
        <li>
          <a href="{{ route('page.news.index') }}" class="{{ request()->routeIs('page.news*') ? 'is-active' : '' }}">
            Aktuell
          </a>
        </li>
        <li>
          <a href="{{ route('page.office.about') }}" class="{{ request()->routeIs('page.office*') ? 'is-active' : '' }}">
            Büro
          </a>
        </li>
        <li>
          <a href="{{ route('page.contact') }}" class="{{ request()->routeIs('page.contact') ? 'is-active' : '' }}">
            Kontakt
          </a>
        </li>
      </ul>
    </div>
    @if ($menuItems)
      <div class="site-menu__sub js-menu-sub is-hidden {{ request()->routeIs('page.project*') ? 'is-selected' : '' }}" data-menu-sub="projects">
        <a href="javascript:;" class="btn-hide-arrow js-menu-btn-hide js-logo-switch"></a>
        <ul>
          @foreach($menuItems as $menuItem)
            @if ($menuItem['category'] == 3)
              <li>
                <a href="{{ route('page.project.se')}}" class="{{ request()->routeIs('page.project.se') ? 'is-active' : '' }}">
                  {{$menuItem['label']}}
                </a>
              </li>
            @else
              <li>
                <a href="javascript:;" class="{{ isset($project) && $project->category == $menuItem['category'] ? 'is-active' : '' }} js-menu-sub-item">
                  {{$menuItem['label']}}
                </a>
                @if ($menuItem['items'])
                  <ul>
                    @foreach($menuItem['items'] as $item)
                      <li>
                        <a 
                          href="{{ route('page.project.show', ['slug' => AppHelper::slug($item->name), 'project' => $item->id]) }}"
                          class="{{ isset($project) && $project->id == $item->id ? 'is-active' : '' }}"
                        >
                          {{$item->name}}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </li>
              @endif
            @endif
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</nav>