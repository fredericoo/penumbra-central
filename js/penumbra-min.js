let isotope,theToggler=document.getElementById("toggler");theToggler.onclick=function(){document.body.classList.toggle("menu-open")};let docViewTop=jQuery(window).scrollTop(),docViewBottom=docViewTop+64;const navBar=document.querySelector("#wrapper-navbar"),lineEq=(t,e,o,r,n)=>{var c=(t-e)/(o-r);return c*n+(e-c*r)};let $root=jQuery("html, body");function setupContent(){lazyLoadInstance.update();var t=document.querySelectorAll(".carousel");[].map.call(t,t=>{let e=Flickity.data(t);if(!e){const o=t.getAttribute("data-flickity");if(o){const r=JSON.parse(o);e=new Flickity(t,r)}else e=new Flickity(t);e.on("dragStart",()=>e.slider.childNodes.forEach(t=>t.style.pointerEvents="none")),e.on("dragEnd",()=>e.slider.childNodes.forEach(t=>t.style.pointerEvents="all"))}}),isotope=jQuery(".grid--packery").isotope({itemSelector:".grid__item",percentPosition:!0,layoutMode:"packery",packery:{columnWidth:".grid-sizer"}}),isotope=jQuery(".grid--fitRows").isotope({itemSelector:".grid__item",percentPosition:!0,layoutMode:"fitRows",fitRows:{columnWidth:".grid-sizer"}}),setTimeout((function(){scrollPop.doPop()}),200),document.querySelectorAll(".readypop").forEach(t=>{t.classList.add("pop")}),document.querySelectorAll(".quantity input").forEach(t=>{t.value=addLeadingZero(t.value)})}$root.on("click","a.scroll",(function(){return $root.animate({scrollTop:jQuery(jQuery.attr(this,"href")).offset().top},500),!1})),document.addEventListener("scroll",t=>{docViewTop=jQuery(window).scrollTop(),docViewBottom=docViewTop+64});const addLeadingZero=t=>{for(t=t.replace(/^0+/,"");t.length<4;)t="0"+t;return t};jQuery(document).ready((function(t){t("body").on("keyup",".quantity input",(function(){jQuery("[name='update_cart']").trigger("click"),t(this).val(addLeadingZero(t(this).val()))})),t("body").on("click",".product-quantity button.plus, .product-quantity button.minus",(function(){document.querySelector("[name='update_cart']").removeAttribute("disabled")})),t("body").on("click",".ch-qty button.plus, .ch-qty button.minus, .product-quantity button.plus, .product-quantity button.minus",(function(){var e=t(this).parent().find(".qty"),o=parseFloat(e.val()),r=parseFloat(e.attr("max")),n=parseFloat(e.attr("min")),c=parseFloat(e.attr("step"));t(this).is(".plus")?r&&r<=o?e.val(r):e.val(o+c):n&&n>=o?e.val(n):o>1&&e.val(o-c),t(this).closest(".produto__addtocart").find(".add_to_cart_button").attr("data-quantity",t(".quantity input").val()),e.val(addLeadingZero(e.val()))}))}));var pushdata=[],inTransition=!1;const docMain=document.querySelector("main");!function(){"use strict";let t=document.querySelectorAll(".secao"),e={},o=0,r=!1;[].forEach.call(t,(function(t){e[t.id]=t.offsetTop})),window.onscroll=()=>{let t=document.documentElement.scrollTop||document.body.scrollTop,n="";for(o in e)e[o]<=t+120&&(n=o);if(""!=n){const t=document.querySelector("a[href*="+n+"]");t.classList.contains("current")||(document.querySelectorAll(".current").forEach(t=>t.classList.remove("current")),t.classList.add("current"),r||(r=!0,jQuery(".scrollmenu .container").animate({scrollLeft:t.offsetLeft},500,()=>r=!1)))}}}();