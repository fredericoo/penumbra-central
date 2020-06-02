let theToggler = document.getElementById('toggler');

theToggler.onclick = function () {
    document.body.classList.toggle('menu-open');
};
let isotope;
let docViewTop = jQuery(window).scrollTop();
let docViewBottom = docViewTop + 64;
const navBar = document.querySelector('#wrapper-navbar');

const lineEq = (y2, y1, x2, x1, currentVal) => {
    // y = mx + b
    var m = (y2 - y1) / (x2 - x1), b = y1 - m * x1;
    return m * currentVal + b;
};

let $root = jQuery('html, body');
$root.on("click", 'a.scroll',function () {
    $root.animate({
        scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
    }, 500);

    return false;
});

document.addEventListener("scroll", e => {
  docViewTop = jQuery(window).scrollTop();
  docViewBottom = docViewTop + 64;
});

function setupContent() {

  lazyLoadInstance.update();

  // initialise flickity
  var flktyCarousels = document.querySelectorAll('.carousel');
  [].map.call(flktyCarousels, carousel => {
    let flkty = Flickity.data(carousel);
    if (!flkty) {
      const flktyData = carousel.getAttribute('data-flickity');
      if (flktyData) {
        const flktyOptions = JSON.parse(flktyData);
        flkty = new Flickity(carousel, flktyOptions);
      } else {
        flkty = new Flickity(carousel);
      }
      // do not activate anything whilst the user is dragging
      flkty.on('dragStart', () => flkty.slider.childNodes.forEach(slide => slide.style.pointerEvents = "none") );
      flkty.on('dragEnd', () => flkty.slider.childNodes.forEach(slide => slide.style.pointerEvents = "all") );
    }
  });

  setTimeout(function() {
    scrollPop.doPop();
  }, 200);
  document.querySelectorAll(".readypop").forEach(pop => { pop.classList.add('pop') });
  document.querySelectorAll('.quantity input').forEach( qtyinput => { qtyinput.value = addLeadingZero(qtyinput.value); })

}

const addLeadingZero = value => {
  value = value.replace(/^0+/, '');
  while (value.length < 4) { value = "0" + value; }
  return value;
}

jQuery(document).ready(function($){

   $('body').on( 'click', '.ch-qty button.plus, .ch-qty button.minus, .product-quantity button.plus, .product-quantity button.minus', function() {

      // Get current quantity values
      var qty = $( this ).parent().find( '.qty' );
      var val   = parseFloat(qty.val());
      var max = parseFloat(qty.attr( 'max' ));
      var min = parseFloat(qty.attr( 'min' ));
      var step = parseFloat(qty.attr( 'step' ));

      // Change the value if plus or minus
      if ( $( this ).is( '.plus' ) ) {
         if ( max && ( max <= val ) ) {
            qty.val( max );
         } else {
            qty.val( val + step );
         }
      } else {
         if ( min && ( min >= val ) ) {
            qty.val( min );
         } else if ( val > 1 ) {
            qty.val( val - step );
         }
      }
      $( this ).closest( '.produto__addtocart' ).find('.add_to_cart_button').attr('data-quantity', $('.quantity input').val());

      qty.val(addLeadingZero(qty.val()));

      if ($(this).closest('.shop_table').get(0)) {
        updateCartPage();
      }

   });

});

var pushdata = [];
var inTransition = false;
const docMain = document.querySelector('main');

(function() {
  'use strict';

  let section = document.querySelectorAll(".secao");
  let sections = {};
  let i = 0;
  let isAnimating = false;

  [].forEach.call(section, function(e) {
    sections[e.id] = e.offsetTop;
  });

  window.onscroll = () => {
    const scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
    let selectedPos = '';

    for (i in sections) {
      if (sections[i] <= (scrollPosition+120) ) {
        selectedPos = i;
      }
    }

    if (selectedPos != '') {
      const scrollSelected = document.querySelector('a[href*=' + selectedPos + ']');
      if (!scrollSelected.classList.contains('current')) {
        document.querySelectorAll('.current').forEach(current => current.classList.remove('current') );
        scrollSelected.classList.add('current');
        if (!isAnimating) {
          isAnimating = true;
          jQuery('.scrollmenu .container').animate(
          {  scrollLeft: scrollSelected.offsetLeft },
          300,
          () => isAnimating = false);
        }
    }
  }
}
})();


// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
  let debounceTimeout;
  threshold = threshold || 100;
  return function debounced() {
    clearTimeout( debounceTimeout );
    var args = arguments;
    var _this = this;
    function delayed() {
      fn.apply( _this, args );
    }
    debounceTimeout = setTimeout( delayed, threshold );
  };
}
