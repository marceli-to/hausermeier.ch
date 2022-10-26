function debounce(a,b,c){var d;return function(){var e=this,f=arguments;clearTimeout(d),d=setTimeout(function(){d=null,c||a.apply(e,f)},b),c&&!d&&a.apply(e,f)}}

var Works = (function() {
	
	var selectors = {
    html:     'html',
    body:     'body',
    btnWorks: '.js-btn-works',
    wrapperWorks: '.js-works'
  };
  
  var classes = {
    active:   'is-active',
  };

  // media queries
  var bp = {
    sm: window.matchMedia("(max-width: 1023px)"),
    md: window.matchMedia("(min-width: 1024px)"),
  };

  var _initialize = function() {

    if (bp.sm.matches) {
      $(selectors.btnWorks).each(function(){
        $(this).toggleClass(classes.active);
      });
    }

    _bind();

  };

  var _bind = function() {
    $(selectors.body).on('click', selectors.btnWorks, function(){
      _toggle($(this));
    });

    // $(window).resize(function(event){
    //   _resize();
    // });
  };

  var _toggle = function(btn) {

    var type = btn.parent('li').data('type');

    $(selectors.wrapperWorks).hide();
    $(selectors.wrapperWorks + '[data-type="'+type+'"]').show();
    
    if (bp.sm.matches) {
      $(selectors.btnWorks).parent('li').show();
      $(selectors.btnWorks).addClass(classes.active);
      $(selectors.btnWorks + '[data-type="'+type+'"]').addClass(classes.active);
      btn.parent('li').hide();
      btn.removeClass(classes.active);
    }
    else {
      $(selectors.btnWorks).removeClass(classes.active);
      btn.addClass(classes.active);
    }
  };

  // var _resize = debounce(function(){
  //   if (bp.md.matches) {
  //     var type = $(selectors.btnWorks + '.' + classes.active).parent('li').data('type');
  //     $(selectors.wrapperWorks).hide();
  //     $(selectors.wrapperWorks + '[data-type="'+type+'"]').show();
  //   }
  // }, 10);

  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Works.init();
});

