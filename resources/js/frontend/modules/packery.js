
var PackeryUi = (function() {

	// selectors
	var selectors = {
    html: 'html',
    body: 'body',
    masonry: {
      container: '.js-msnry',
      item: '.js-msnry-item',
    },
	};
   
  // Init
	var _initialize = function() {

    $(selectors.masonry.container).imagesLoaded( function() {
      $(selectors.masonry.container).packery({
          itemSelector: selectors.masonry.item,
          percentPosition: true,
          gutter: 15,
          transitionDuration: 0
        });
      });
    };

    /* --------------------------------------------------------------
     * RETURN PUBLIC METHODS
     * ------------------------------------------------------------ */

    return {
        init:  _initialize,
	};
	
})();

// Initialize
$(function() {
  PackeryUi.init();
});

