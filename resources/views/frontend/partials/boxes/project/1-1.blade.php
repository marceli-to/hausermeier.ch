<div class="box-1-1">
  <div>
    <div class="box__c">
      <div>
        @if (isset($elements[0]))
          @if ($elements[0]->image)
            @include('frontend.partials.boxes.project.image', array('image' => $elements[0]->image, 'image_attribute' => 'height="475" width="680"'))
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
            @include('frontend.partials.boxes.project.image', array('image' => $elements[1]->image, 'image_attribute' => 'height="475" width="680"'))
          @endif
        @endif
      </div>
    </div>
  </div>
</div>