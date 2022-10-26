<div class="box-1-1">
  <div>
    <div class="box__c">
      <div>
        @if (isset($elements[0]))
          @if ($elements[0]->image)
            @include('frontend.partials.boxes.home.image', array('image' => $elements[0]->image, 'image_attribute' => 'height="475" width="682"'))
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
  </div>
  <div>
    <div class="box__c">
      <div>
        @if (isset($elements[1]))
          @if ($elements[1]->image)
            @include('frontend.partials.boxes.home.image', array('image' => $elements[1]->image, 'image_attribute' => 'height="475" width="682"'))
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
</div>