

// jQuery(document).on('click', '[data-post-id]', {}, function(e) {
//   e.preventDefault();
//   if (jQuery('body.transition').length) {
//     return;
//   }
//   if (inTransition) {
//     return;
//   }
//   var this_loader = jQuery(e.currentTarget);
//   var thisUrl = jQuery(e.currentTarget).attr("href");
//   loadContent(null,this_loader);
//   e.stopImmediatePropagation();
//   return false;
// });

window.addEventListener('popstate', function(e) {
  if (e != null && e.state != null) {
    var pageid = e.state.id;
    var pageurl = e.state.url;
    if (pageid == null) {
      pageid = myAjax.homeid;
    }
    loadContent(pageid, jQuery());
  }
});

function loadContent(pageid,loaderObj) {
  inTransition = true;
  jQuery('body').addClass('transition');
  jQuery('body').removeClass('menu-open');
  jQuery('.pop').removeClass('pop');
  jQuery('.loader-obj').removeClass('loader-obj');
  jQuery('.menu-item').removeClass('active');
  loaderObj.parent('.menu-item').addClass('active');
  loaderObj.addClass('loader-obj');
  postId = loaderObj.attr("data-post-id");
  if (pageid != null) {postId = pageid;}
  jQuery.ajax({
    type: "post",
    dataType: "json",
    url: myAjax.ajaxurl,
    data: {
      action: "carregar_post",
      post_id: postId
    },
    success: function(response) {
      jQuery("html, body").animate({
        "placeholder": 0
      }, 900, function() {

        if (response.type == "success") {
          if (inTransition) {
            inTransition = false;
            //only push state if post id not specified
            if (pageid == null) {
              history.pushState({
                id: postId,
                url: response.url
              }, null, response.url);
            }
            docMain.innerHTML = response.html;
            docMain.setAttribute('data-this-id',postId);
            document.title = response.tabtitle;
            setupContent();
          }
        }
        else {
          jQuery('main').html('could not load content.');
        }
        jQuery(window).scrollTop(0);
        jQuery("html, body").animate({
          "placeholder": 0
        }, 50, function() {
          jQuery('body').removeClass('transition');
          jQuery('body').attr('class', response.bodyclass);
        });

      });
    }
  });
}

let lastClickedProduct;

jQuery('#modal').on('show.bs.modal', function (event) {
  lastClickedProduct = event.relatedTarget;
  const props = ['.produto__titulo','.produto__desc','.produto__preco', '.produto__imagem']
  const modal = this
  const product = event.relatedTarget // Button that triggered the modal
  props.forEach( prop => {
    if (modal.querySelector(prop) && product.querySelector(prop))
    modal.querySelector(prop).innerHTML = product.querySelector(prop).innerHTML;
  })
  modal.querySelector('.produto__imagem>img').setAttribute('src',product.getAttribute('data-fullimage'));
  modal.querySelector('.produto__imagem>img').className = "lazyload fade"

  modal.querySelector('.produto__info').appendChild(lastClickedProduct.querySelector('.produto__addtocart'));

  lazyLoadInstance.update();
  scrollPop.updatePoppable();
  setTimeout(function() {
            scrollPop.doPop();
  }, 100);

})

jQuery('#modal').on('hidden.bs.modal', function (event) {
  if (lastClickedProduct) {
    console.log(lastClickedProduct)
    lastClickedProduct.appendChild(this.querySelector('.produto__addtocart'));
  }
});

let addButton;

jQuery(document).on('click', '[data-target]', {}, function(e) {
  e.preventDefault();
});

jQuery('body').on('click','.ctl-add',function(e){
  if (this.classList.contains('disabled')) return false;
  this.classList.add('adding');
  this.innerHTML = 'adicionando…';
  addButton = this;
})

jQuery('body').on('added_to_cart',function(){
  if (addButton) {
    addButton.classList.remove('adding');
    addButton.classList.add('added');
    addButton.innerHTML = "Adicionar ao carrinho";
    addButton = null;
  }
    jQuery('#modal').modal('hide');
    updateCartPage();
  if (!document.querySelector('.ctl-cart')) return false;
  document.querySelector('.ctl-cart').classList.add('animate');
  jQuery.ajax({
    type: "post",
    dataType: "json",
    url: myAjax.ajaxurl,
    data: {
      action: "get_cart_number"
    },
    success: function(response) {
        if (response.type == "success") {
          document.querySelector('.ctl-cart__count .no').innerHTML = response.qty
          document.querySelector('.ctl-cart__total .no').innerHTML = response.total
          document.querySelector('.ctl-cart').classList.remove('animate');
          document.querySelector('.ctl-cart').classList.add('pop');
          return false;
        }
    }});

});

const updateCartPage = () => {
  if (cartBtn = document.querySelector("[name='update_cart']")) {

    cartBtn.removeAttribute('disabled');
    jQuery(cartBtn).trigger("click");
  }
}
