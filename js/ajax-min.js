function loadContent(t,e){inTransition=!0,jQuery("body").addClass("transition"),jQuery("body").removeClass("menu-open"),jQuery(".pop").removeClass("pop"),jQuery(".loader-obj").removeClass("loader-obj"),jQuery(".menu-item").removeClass("active"),e.parent(".menu-item").addClass("active"),e.addClass("loader-obj"),postId=e.attr("data-post-id"),null!=t&&(postId=t),jQuery.ajax({type:"post",dataType:"json",url:myAjax.ajaxurl,data:{action:"carregar_post",post_id:postId},success:function(e){jQuery("html, body").animate({placeholder:0},900,(function(){"success"==e.type?inTransition&&(inTransition=!1,null==t&&history.pushState({id:postId,url:e.url},null,e.url),docMain.innerHTML=e.html,docMain.setAttribute("data-this-id",postId),document.title=e.tabtitle,setupContent()):jQuery("main").html("could not load content."),jQuery(window).scrollTop(0),jQuery("html, body").animate({placeholder:0},50,(function(){jQuery("body").removeClass("transition"),jQuery("body").attr("class",e.bodyclass)}))}))}})}let lastClickedProduct,addButton;window.addEventListener("popstate",(function(t){if(null!=t&&null!=t.state){var e=t.state.id;t.state.url;null==e&&(e=myAjax.homeid),loadContent(e,jQuery())}})),jQuery("#modal").on("show.bs.modal",(function(t){lastClickedProduct=t.relatedTarget;const e=this,o=t.relatedTarget;[".produto__titulo",".produto__desc",".produto__preco",".produto__imagem"].forEach(t=>{e.querySelector(t)&&o.querySelector(t)&&(e.querySelector(t).innerHTML=o.querySelector(t).innerHTML)}),e.querySelector(".produto__imagem>img").setAttribute("src",o.getAttribute("data-fullimage")),e.querySelector(".produto__imagem>img").className="lazyload fade",e.querySelector(".produto__info").appendChild(lastClickedProduct.querySelector(".produto__addtocart")),lazyLoadInstance.update(),scrollPop.updatePoppable(),setTimeout((function(){scrollPop.doPop()}),100)})),jQuery("#modal").on("hidden.bs.modal",(function(t){lastClickedProduct&&(console.log(lastClickedProduct),lastClickedProduct.appendChild(this.querySelector(".produto__addtocart")))})),jQuery(document).on("click","[data-target]",{},(function(t){t.preventDefault()})),jQuery("body").on("click",".ctl-add",(function(t){if(this.classList.contains("disabled"))return!1;this.classList.add("adding"),this.innerHTML="adicionando…",addButton=this})),jQuery("body").on("added_to_cart",(function(){if(addButton&&(addButton.classList.remove("adding"),addButton.classList.add("added"),addButton.innerHTML="Adicionar ao carrinho",addButton=null),jQuery("#modal").modal("hide"),updateCartPage(),!document.querySelector(".ctl-cart"))return!1;document.querySelector(".ctl-cart").classList.add("animate"),jQuery.ajax({type:"post",dataType:"json",url:myAjax.ajaxurl,data:{action:"get_cart_number"},success:function(t){if("success"==t.type)return document.querySelector(".ctl-cart__count .no").innerHTML=t.qty,document.querySelector(".ctl-cart__total .no").innerHTML=t.total,document.querySelector(".ctl-cart").classList.remove("animate"),document.querySelector(".ctl-cart").classList.add("pop"),!1}})}));const updateCartPage=()=>{(cartBtn=document.querySelector("[name='update_cart']"))&&(cartBtn.removeAttribute("disabled"),jQuery(cartBtn).trigger("click"))};