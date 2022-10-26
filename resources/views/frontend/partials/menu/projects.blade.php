<ul class="js-page-menu-sub">
  @foreach($menuItems as $menuItem)
    <li>
      @if ($menuItem['category'] == 3)
        <a href="{{ route('page.project.se')}}" class="{{ request()->routeIs('page.project.se') ? 'is-active' : '' }}">
          {{$menuItem['label']}}
        </a>
      @else
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
        @endif
      @endif
    </li>
  @endforeach
</ul>
