var Strategy = (function() {
	
	var selectors = {
    html:       'html',
    body:       'body',
    btnSe:     '.js-btn-se',
    wrapperSe: '.js-se'
  };

  var classes = {
    active: 'is-active',
  };
  
  var _initialize = function() {
    _bind();
  };

  var _bind = function() {
    $(selectors.body).on('click', selectors.btnSe, function(){
      _toggle($(this));
    });
  };

  var _toggle = function(btn){
    btn.toggleClass(classes.active);
    btn.next(selectors.wrapperSe).toggle();
  };

  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Strategy.init();
});

