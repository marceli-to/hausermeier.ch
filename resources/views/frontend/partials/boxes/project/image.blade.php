@if ($image->is_lightbox)
<a href="/image/lightbox/{{$image->name}}" data-fancybox="gallery" data-caption="{{$image->caption}}" data-plan="{{$image->is_plan}}">
  <img src="/image/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan ? 'is-plan' : ''}}">
</a>
@else
<img src="/image/project-preview/{{$image->name}}" {!! $image_attribute !!} alt="{{$image->caption}}" class="{{$image->is_plan == 1 ? 'is-plan' : ''}}">
@endif
