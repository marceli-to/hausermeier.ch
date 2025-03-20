@if ($image->discourse->is_all)
  <a href="{{ route('page.news.index') }}" title="{{$image->discourse->title}}">
    <img src="/img/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan == 1 ? 'is-plan' : ''}}">
    @if ($image->discourse->title)
      <div class="caption">{{$image->discourse->title}}</div>
    @endif
  </a>
@elseif ($image->discourse->is_discourse)
  <a href="{{ route('page.news.discourse') }}" title="{{$image->discourse->title}}">
    <img src="/img/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan == 1 ? 'is-plan' : ''}}">
    @if ($image->discourse->title)
      <div class="caption">{{$image->discourse->title}}</div>
    @endif
  </a>
@elseif ($image->discourse->is_publication)
  <a href="{{ route('page.news.publications') }}" title="{{$image->discourse->title}}">
    <img src="/img/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan == 1 ? 'is-plan' : ''}}">
    @if ($image->discourse->title)
      <div class="caption">{{$image->discourse->title}}</div>
    @endif
  </a>
@endif
