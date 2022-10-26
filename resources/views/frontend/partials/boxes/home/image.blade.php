<a href="{{ route('page.project.show', ['slug' => AppHelper::slug($image->project->name), 'project' => $image->project->id]) }}" title="{{$image->project->name}}, {{$image->project->location}}">
  <img src="/image/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan == 1 ? 'is-plan' : ''}}">
  @if ($image->project->short_title)
    <div class="caption">{{$image->project->short_title}}</div>
  @endif
</a>
