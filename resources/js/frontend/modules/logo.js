var Logo = (function() {
	
	var selectors = {
    html:  'html',
    body:  'body',
    btn:   '.js-logo-switch',
    logo:  '.js-logo-variation',
  };

  
  var _initialize = function() {
    _bind();
  };

  var _bind = function() {
    $(selectors.body).on('click', selectors.btn, function(){
      _change();
    });
  };

  var _change = function() {
    let variation = Math.floor(Math.random() * (30 - 1)) + 1;
    $(selectors.logo).hide();
    $('[data-logo="'+ variation +'"]').show();
  };

  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Logo.init();
});

