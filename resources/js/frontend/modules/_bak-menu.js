import debounce from '../vendor/debounce';

var Menu = (function() {
	
	// selectors
	var selectors = {
    html:            'html',
    body:            'body',
    menu:            '.js-menu',
    menuMain:        '.js-menu-main',
    menuSub:         '.js-menu-sub',
    menuPageSub:     '.js-page-menu-sub',
    menuSubProjects: '.js-menu-projects',
    menuBtn:         '.js-menu-btn',
    menuBtnHide:     '.js-menu-btn-hide',
    menuParentItem:  '.js-menu-parent',
    menuSubItem:     '.js-menu-sub-item',
	};

  // css classes
  var classes = {
    active:   'is-active',
    visible:  'is-visible',
    selected: 'is-selected',
    hidden:   'is-hidden',
    open:     'is-open',
    parent:   'is-parent',
    hasMenu:  'has-menu',
  };

  // media queries
  var bp = {
    sm: window.matchMedia("(max-width: 1023px)"),
    md: window.matchMedia("(min-width: 1024px)"),
  };

  // Init
  var _initialize = function() {
    _bind();
  };

  // Bind events
  var _bind = function() {
    $(selectors.body).on('click', selectors.menuBtn, function(){
      if (bp.sm.matches) {
        window.scrollTo(0,0);
      }
      _toggle($(this));
    });

    $(selectors.body).on('click', selectors.menuParentItem, function(){
      _toggleSub($(this));
    });

    $(selectors.body).on('click', selectors.menuSubItem, function(){
      if (bp.sm.matches) {
        $(selectors.menuSub + ' ul ul').removeClass(classes.visible);
        $(this).next('ul').toggleClass(classes.visible);
      }
    });

    $(selectors.body).on('mouseover', selectors.menuSubItem, function(){
      if (bp.md.matches) {
        $(selectors.menuSub).height(_getSubMenuHeight() + 40);
        $(selectors.menuPageSub).height(_getProjectSubMenuHeight() + 40);
      }
    });

    $(selectors.body).on('mouseleave', selectors.menuSub, function(){
      if (bp.md.matches) {
        $(this).height('auto');
        $(selectors.menuPageSub).height('auto');
      }
    });

    $(selectors.body).on('mouseleave', selectors.menuPageSub, function(){
      if (bp.md.matches) {
        $(this).height('auto');
        $(selectors.menuSub).height('auto');
      }
    });

    $(selectors.body).on('click', selectors.menuBtnHide, function(){
      if (bp.md.matches) {
        _hideSub();
      }
    });

    window.addEventListener('scroll', _scroll);

  };

  var _scroll = debounce(function() {
    let treshold = 230;

    if (window.scrollY > treshold && $(selectors.menuBtn).hasClass(classes.active) && bp.sm.matches) {
      $(selectors.menuBtn).removeClass(classes.active);
      $(selectors.menu).removeClass(classes.visible);
      //$(selectors.menuMain).addClass(classes.hidden);
      $(selectors.menuSub).removeClass(classes.selected);
      $(selectors.menuParentItem).removeClass(classes.selected);
      $(selectors.menuSubItem).next('ul').removeClass(classes.visible);
    }

  }, 100);

  var _toggle = function(btn) {
    btn.toggleClass(classes.active);
    $(selectors.menu).toggleClass(classes.visible);
  };

  var _toggleSub = function(btn) {
    btn.toggleClass(classes.selected);

    if (bp.md.matches) {
      $(selectors.menuMain).toggleClass(classes.hidden);
      $(selectors.menuSub).toggleClass(classes.hidden);
    }

    let target = btn.data('menuParent');
    if (btn.hasClass(classes.selected)) {
      $(selectors.menuSub + '[data-menu-sub="'+target+'"]').addClass(classes.selected);
    }
    else {
      $(selectors.menuSub + '[data-menu-sub="'+target+'"]').removeClass(classes.selected);
    }

    if (bp.md.matches) {
      if ($(selectors.menuMain).hasClass(classes.hidden)) {
        $(selectors.menuSub).addClass(classes.selected);
      }
    }
  };

  var _hideSub = function() {
    $(selectors.menuMain).removeClass(classes.hidden);
    $(selectors.menuSub).addClass(classes.hidden);
    $('[data-menu-sub="projects"]').addClass(classes.selected);
  };

  var _getSubMenuHeight = function() {
    var h = 0;
    $(selectors.menuSub + ' ul ul').each(function(){
      if ($(this).innerHeight() >= h) {
        h = $(this).innerHeight();
      }
    });
    return h;
  };


  var _getProjectSubMenuHeight = function() {
    var h = 0;
    $(selectors.menuPageSub + ' ul').each(function(){
      if ($(this).innerHeight() > h) {
        h = $(this).innerHeight();
      }
    });
    return h;
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
  Menu.init();
});

