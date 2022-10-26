<div class="box-1">
  <div>
    <div class="box__e">
      <div>
        @if (isset($elements[0]))
          @if ($elements[0]->image)
            @include('frontend.partials.boxes.project.image', array('image' => $elements[0]->image, 'image_attribute' => 'height="639" width="1380"'))
          @endif
        @endif
      </div>
    </div>
  </div>
</div>