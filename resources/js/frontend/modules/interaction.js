var Interaction = (function() {
	
	var selectors = {
    html:               'html',
    body:               'body',
    btnInteraction:     '.js-btn-interaction',
    wrapperInteraction: '.js-interaction'
  };

  var classes = {
    active: 'is-active',
  };
  
  var _initialize = function() {
    _bind();
  };

  var _bind = function() {
    if (window.location.hash) {
      var hash = window.location.hash.substring(1);
      setTimeout(function(){
        $.scrollTo($('[data-article="'+ hash +'"]'), 800);
      }, 400);
    }
    $(selectors.body).on('click', selectors.btnInteraction, function(){
      _toggle($(this));
    });
  };

  var _toggle = function(btn){
    btn.toggleClass(classes.active);
    btn.next(selectors.wrapperInteraction).toggle();
  };

  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Interaction.init();
});

