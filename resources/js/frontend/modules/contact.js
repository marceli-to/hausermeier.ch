var Contact = (function() {
	
	var selectors = {
    html:           'html',
    body:           'body',
    btnImprint:     '.js-btn-imprint',
    wrapperImprint: '.js-imprint'
  };
  
  // css classes
  var classes = {
    active: 'is-active',
  };

  var _initialize = function() {
    _bind();
  };

  var _bind = function() {
    $(selectors.body).on('click', selectors.btnImprint, function(){
      $(selectors.wrapperImprint).toggle();
      $(selectors.btnImprint).toggleClass(classes.active);
    });
  };

  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Contact.init();
});

