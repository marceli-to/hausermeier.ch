function debounce(a,b,c){var d;return function(){var e=this,f=arguments;clearTimeout(d),d=setTimeout(function(){d=null,c||a.apply(e,f)},b),c&&!d&&a.apply(e,f)}}

var Projects = (function() {

  // selectors
  var selectors = {
    html:        'html',
    body:        'body',
    btnInfo:     '.js-btn-info',
    wrapperInfo: '.js-info'
  };
  
  // css classes
  var classes = {
    visible: 'is-visible',
    active: 'is-active',
  };

  var _initialize = function() {
    _bind();
  };

  var _bind = function() {
    $(selectors.body).on('click', selectors.btnInfo, function(){
      _toggle();
    });
  };

  var _toggle = function() {
    $(selectors.btnInfo).toggleClass(classes.active);
    $(selectors.wrapperInfo).toggleClass(classes.visible);
  };

  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Projects.init();
});

