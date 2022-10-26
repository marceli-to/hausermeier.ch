function debounce(a,b,c){var d;return function(){var e=this,f=arguments;clearTimeout(d),d=setTimeout(function(){d=null,c||a.apply(e,f)},b),c&&!d&&a.apply(e,f)}}

var Header = (function() {

  /* --------------------------------------------------------------
    * VARIABLES
    * ------------------------------------------------------------ */

  // selectors
  var selectors = {
    html:    'html',
    body:    'body',
    header:  'header.site-header',
  };

  // css classes
  var classes = {
    tiny: 'is-tiny',
    hidden: 'is-hidden',
  };

  var mq = {
    sm: window.matchMedia("(max-width: 900px)"),
    md: window.matchMedia("(min-width: 901px)")
  };

  var lastScrollPos = 0;

  var _initialize = function() {
    
    $(window).scroll(function(event){
      //_scroll();
    });
  };

  var _scroll = debounce(function(){
      // current scroll position
      var scrollPos = $(this).scrollTop();

      // small devices / mobiles
      if (mq.sm.matches) {
        if (scrollPos > lastScrollPos){
          $(selectors.header).addClass(classes.tiny);
        }
        if (scrollPos == 0) {
          $(selectors.header).removeClass(classes.tiny);
        }
      }
      else {
        if ($(this).scrollTop() <= 0) {
          $(selectors.header).removeClass(classes.tiny);
          return;
        }
        if (scrollPos > lastScrollPos && scrollPos > 30){
          $(selectors.header).addClass(classes.hidden).removeClass(classes.tiny);
        }
        else if (scrollPos < lastScrollPos && scrollPos > 30) {
          $(selectors.header).removeClass(classes.hidden).addClass(classes.tiny);
        }
      }

      lastScrollPos = scrollPos;
  }, 10)
  
  /* --------------------------------------------------------------
  * RETURN PUBLIC METHODS
  * ------------------------------------------------------------ */
        
  return {
    init: _initialize,
  };

})();

// Initialize
$(function() {
  Header.init();
});