<div class="box-1-2">
  <div>
    <div class="box__a">
      <div>
        @if (isset($elements[0]))
          @if ($elements[0]->text)
            @include('frontend.partials.boxes.project.text', array('text' => $elements[0]->text))
          @endif
          @if ($elements[0]->image)
            @include('frontend.partials.boxes.project.image', array('image' => $elements[0]->image, 'image_attribute' => 'height="639" width="450"'))
          @endif
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="box__b">
      <div>
        @if (isset($elements[1]))
          @if ($elements[1]->image)
            @include('frontend.partials.boxes.project.image', array('image' => $elements[1]->image, 'image_attribute' => 'height="639" width="915"'))
          @endif
        @endif
      </div>
    </div>
  </div>
</div>