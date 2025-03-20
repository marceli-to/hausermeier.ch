<a href="/interaktionen/#{{AppHelper::slug($image->interactionProject->title)}}">
  <img src="/img/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan == 1 ? 'is-plan' : ''}}">
  @if ($image->interactionProject->title)
    <div class="caption">{{$image->interactionProject->title}}</div>
  @endif
</a>
