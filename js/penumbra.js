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

  var nodeList = document.querySelectorAll('.carousel');
  for (var i = 0, t = nodeList.length; i < t; i++) {
    var flkty = Flickity.data(nodeList[i]);
    if (!flkty) {
      var flktyData = nodeList[i].getAttribute('data-flickity');
      if (flktyData) {
        var flktyOptions = JSON.parse(flktyData);
        new Flickity(nodeList[i], flktyOptions);
      } else {
        new Flickity(nodeList[i]);
      }
    }
  }

  isotope = jQuery('.grid--packery').isotope({
    itemSelector: '.grid__item',
    percentPosition: true,
    layoutMode: 'packery',
    packery: {
      columnWidth: '.grid-sizer'
    }
  });
  isotope = jQuery('.grid--fitRows').isotope({
    itemSelector: '.grid__item',
    percentPosition: true,
    layoutMode: 'fitRows',
    fitRows: {
      columnWidth: '.grid-sizer'
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

   $('body').on( 'keyup', '.quantity input', function() {
     jQuery("[name='update_cart']").trigger("click");
     $(this).val(addLeadingZero($(this).val()));
   });

   $('body').on( 'click', '.product-quantity button.plus, .product-quantity button.minus', function() {
     document.querySelector("[name='update_cart']").removeAttribute('disabled');
   });

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
      // if (val > min) {
      //   $('.ch-qty button.minus').removeClass('disabled');
      // } else {
      //   $('.ch-qty button.minus').addClass('disabled');
      // }

   });

});


var pushdata = [];
var inTransition = false;
const docMain = document.querySelector('main');
