const checkoutBtn = document.querySelector('.wc-proceed-to-checkout .btn');
let upsellShown = false;
  document.querySelector('#precart').addEventListener('scroll', ev => scrollPop.doPop(ev));

checkoutBtn.addEventListener("click", (e) => {
  if (upsellShown) return;
  e.preventDefault();
  jQuery('#precart').modal('show');
  upsellShown = true;
});

jQuery('#precart').on('show.bs.modal', function (event) {
  let button = jQuery(event.relatedTarget) // Button that triggered the modal
  let postId = myAjax.upsell // Extract info from data-* attributes
  let modal = this

    modal.querySelector('.modal-body').innerHTML = '<img src="/wp-content/uploads/2020/04/ctl-loading.gif" class=carregando>'
    modal.querySelector('.fechar').style.display = "none";
  jQuery.ajax({
    type: "post",
    dataType: "json",
    url: myAjax.ajaxurl,
    data: {
      action: "carregar_post",
      post_id: postId
    },
    success: function(response) {
        if (response.type == "success") {
          modal.querySelector('.modal-body').innerHTML = response.html
          modal.querySelector('.fechar').style.display = "block";
          document.querySelector('.quantity input').value = addLeadingZero(document.querySelector('.quantity input').value);
            // history.pushState({
            //   id: postId,
            //   url: response.url
            // }, null, response.url);

          lazyLoadInstance.update();
          scrollPop.updatePoppable();
          setTimeout(function() {
            scrollPop.doPop();
          }, 100);
          return false;
        }
    }});


})
