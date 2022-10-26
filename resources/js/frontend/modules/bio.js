var Bio = (function() {
	
	var selectors = {
    html:       'html',
    body:       'body',
    btnBio:     '.js-btn-bio',
    wrapperBio: '.js-bio',
    btnFormer:  '.js-btn-former',
    wrapperFormer: '.js-former'
  };

  var classes = {
    active: 'is-active',
  };
  
  var _initialize = function() {
    _bind();
  };

  var _bind = function() {
    $(selectors.body).on('click', selectors.btnBio, function(){
      _toggleBio($(this));
    });
    $(selectors.body).on('click', selectors.btnFormer, function(){
      _toggleFormer($(this));
    });
  };

  var _toggleBio = function(btn){
    btn.toggleClass(classes.active);
    btn.next(selectors.wrapperBio).toggle();
  };


  var _toggleFormer = function(btn){
    btn.toggleClass(classes.active);
    btn.next(selectors.wrapperFormer).toggle();
  };

  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Bio.init();
});

