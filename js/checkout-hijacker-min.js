const checkoutBtn=document.querySelector(".wc-proceed-to-checkout .btn");let upsellShown=!1;checkoutBtn.addEventListener("click",e=>{upsellShown||(e.preventDefault(),jQuery("#precart").modal("show"),upsellShown=!0)}),jQuery("#precart").on("show.bs.modal",(function(e){jQuery(e.relatedTarget);let t=myAjax.upsell,o=this;o.querySelector(".modal-body").innerHTML='<img src="/wp-content/uploads/2020/04/ctl-loading.gif" class=carregando>',o.querySelector(".fechar").style.display="none",jQuery.ajax({type:"post",dataType:"json",url:myAjax.ajaxurl,data:{action:"carregar_post",post_id:t},success:function(e){if("success"==e.type)return o.querySelector(".modal-body").innerHTML=e.html,o.querySelector(".fechar").style.display="block",document.querySelector(".quantity input").value=addLeadingZero(document.querySelector(".quantity input").value),lazyLoadInstance.update(),scrollPop.updatePoppable(),setTimeout((function(){scrollPop.doPop()}),100),!1}})}));