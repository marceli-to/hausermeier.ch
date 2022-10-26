<a href="/projekte/strategien-und-entwicklungen/#{{AppHelper::slug($image->strategyProject->title)}}">
  <img src="/image/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan == 1 ? 'is-plan' : ''}}">
  @if ($image->strategyProject->title)
    <div class="caption">{{$image->strategyProject->title}}</div>
  @endif
</a>
