<div class="box-1-1-1">
  <div>
    <div class="box__d">
      <div>
        @if (isset($elements[0]))
          @if ($elements[0]->news)
            @include('frontend.partials.boxes.home.article', array('news' => $elements[0]->news))
          @endif
          @if ($elements[0]->image)
            @include('frontend.partials.boxes.home.image', array('image' => $elements[0]->image, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[0]->strategyImage)
            @include('frontend.partials.boxes.home.strategy-image', array('image' => $elements[0]->strategyImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[0]->interactionImage)
            @include('frontend.partials.boxes.home.interaction-image', array('image' => $elements[0]->interactionImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[0]->discourseImage)
            @include('frontend.partials.boxes.home.discourse-image', array('image' => $elements[0]->discourseImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
        @endif
      </div>
    </div>
    <div class="box__d">
      <div>
        @if (isset($elements[1]))
          @if ($elements[1]->news)
            @include('frontend.partials.boxes.home.article', array('news' => $elements[1]->news))
          @endif
          @if ($elements[1]->image)
            @include('frontend.partials.boxes.home.image', array('image' => $elements[1]->image, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[1]->strategyImage)
            @include('frontend.partials.boxes.home.strategy-image', array('image' => $elements[1]->strategyImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[1]->interactionImage)
            @include('frontend.partials.boxes.home.interaction-image', array('image' => $elements[1]->interactionImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[1]->discourseImage)
            @include('frontend.partials.boxes.home.discourse-image', array('image' => $elements[1]->discourseImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="box__a">
      <div>
        @if (isset($elements[2]))
          @if ($elements[2]->news)
            @include('frontend.partials.boxes.home.article', array('news' => $elements[2]->news))
          @endif
          @if ($elements[2]->image)
            @include('frontend.partials.boxes.home.image', array('image' => $elements[2]->image, 'image_attribute' => 'height="639" width="450"'))
          @endif
          @if ($elements[2]->strategyImage)
            @include('frontend.partials.boxes.home.strategy-image', array('image' => $elements[2]->strategyImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[2]->interactionImage)
            @include('frontend.partials.boxes.home.interaction-image', array('image' => $elements[2]->interactionImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[2]->discourseImage)
            @include('frontend.partials.boxes.home.discourse-image', array('image' => $elements[2]->discourseImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="box__a">
      <div>
        @if (isset($elements[3]))
          @if ($elements[3]->news)
            @include('frontend.partials.boxes.home.article', array('news' => $elements[3]->news))
          @endif
          @if ($elements[3]->image)
            @include('frontend.partials.boxes.home.image', array('image' => $elements[3]->image, 'image_attribute' => 'height="639" width="450"'))
          @endif
          @if ($elements[3]->strategyImage)
            @include('frontend.partials.boxes.home.strategy-image', array('image' => $elements[3]->strategyImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[3]->interactionImage)
            @include('frontend.partials.boxes.home.interaction-image', array('image' => $elements[3]->interactionImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
          @if ($elements[3]->discourseImage)
            @include('frontend.partials.boxes.home.discourse-image', array('image' => $elements[3]->discourseImage, 'image_attribute' => 'height="312" width="450"'))
          @endif
        @endif
      </div>
    </div>
  </div>
</div>