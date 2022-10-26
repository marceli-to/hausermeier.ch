var LogoAnimation = (function() {
	
	var selectors = {
    html:       'html',
    body:       'body',
    wrapper:    '.js-animation',
  };

  var classes = {
    active: 'is-active',
  };
  
  var _initialize = function() {
    if ($(selectors.body).find(selectors.wrapper)) {
      setTimeout(function(){
        $(selectors.wrapper).addClass('has-animation');
      },500);
    }
  };
  
  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  LogoAnimation.init();
});

