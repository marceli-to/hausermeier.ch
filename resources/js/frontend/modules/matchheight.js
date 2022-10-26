//------------------------------
//  LandingUi
//  @requires vendor/matchheight.js
//------------------------------	
$(document).ready(function() {

  if (!Modernizr.cssgrid) {
    $('.grid-4x1 > .work-text-media, .content-contact .grid-2x1 > div').matchHeight({byRow: true});
  }
});
