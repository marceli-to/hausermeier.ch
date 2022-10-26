<div class="box-1-1-1">
  <div>
    <div class="box__d">
      <div>
        @if (isset($elements[0]))
          @if ($elements[0]->text)
            @include('frontend.partials.boxes.project.text', array('text' => $elements[0]->text))
          @endif
          @if ($elements[0]->image)
            @include('frontend.partials.boxes.project.image', array('image' => $elements[0]->image, 'image_attribute' => 'height="312" width="450"'))
          @endif
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="box__d">
      <div>
        @if (isset($elements[1]))
          @if ($elements[1]->text)
            @include('frontend.partials.boxes.project.text', array('text' => $elements[1]->text))
          @endif
          @if ($elements[1]->image)
            @include('frontend.partials.boxes.project.image', array('image' => $elements[1]->image, 'image_attribute' => 'height="312" width="450"'))
          @endif
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="box__d">
      <div>
        @if (isset($elements[2]))
          @if ($elements[2]->text)
            @include('frontend.partials.boxes.project.text', array('text' => $elements[2]->text))
          @endif
          @if ($elements[2]->image)
            @include('frontend.partials.boxes.project.image', array('image' => $elements[2]->image, 'image_attribute' => 'height="312" width="450"'))
          @endif
        @endif
      </div>
    </div>
  </div>
</div>