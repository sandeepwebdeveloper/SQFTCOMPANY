!function(e){function t(t){for(var n,a,l=t[0],u=t[1],s=t[2],p=0,f=[];p<l.length;p++)a=l[p],Object.prototype.hasOwnProperty.call(o,a)&&o[a]&&f.push(o[a][0]),o[a]=0;for(n in u)Object.prototype.hasOwnProperty.call(u,n)&&(e[n]=u[n]);for(c&&c(t);f.length;)f.shift()();return i.push.apply(i,s||[]),r()}function r(){for(var e,t=0;t<i.length;t++){for(var r=i[t],n=!0,l=1;l<r.length;l++){var u=r[l];0!==o[u]&&(n=!1)}n&&(i.splice(t--,1),e=a(a.s=r[0]))}return e}var n={},o={0:0},i=[];function a(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,a),r.l=!0,r.exports}a.m=e,a.c=n,a.d=function(e,t,r){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(a.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)a.d(r,n,function(t){return e[t]}.bind(null,n));return r},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/wp-content/themes/westlinecondos/bundled-assets/";var l=window.webpackJsonp=window.webpackJsonp||[],u=l.push.bind(l);l.push=t,l=l.slice();for(var s=0;s<l.length;s++)t(l[s]);var c=u;i.push([136,1]),r()}({136:function(e,t,r){r(137),e.exports=r(345)},339:function(e,t,r){},345:function(e,t,r){"use strict";r.r(t);var n=r(15),o=r.n(n),i=(r(344),r(339),r(5)),a=r(54),l=r(134);r(340),r(341),r(342);i.b.registerPlugin(a.a,l.a);function u(e){return(u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function s(e,t,r){return(t=function(e){var t=function(e,t){if("object"!==u(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var n=r.call(e,t||"default");if("object"!==u(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(e,"string");return"symbol"===u(t)?t:String(t)}(t))in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var c=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),s(this,"events",(function(){var e=o()(".menu-btn-wrap"),t=o()(".menu-btn-bar"),r=o()(".open-menu-block"),n=o()(".menu-block-wrap").find("li");i.b.set(r,{autoAlpha:0}),i.b.set(n,{y:20,autoAlpha:0}),e.on("click",(function(){r.hasClass("open")?(i.b.timeline().to(n,{y:20,autoAlpha:0,duration:.3,ease:"power2.inOut",stagger:.05}).to(r,{autoAlpha:0,duration:.3,ease:"power2.inOut"},"<"),r.removeClass("open"),i.b.to(t.eq(0),{rotation:0,y:0,transformOrigin:"center center",duration:.3,ease:"power2.inOut"}),i.b.to(t.eq(1),{autoAlpha:1,duration:.3,ease:"power2.inOut"}),i.b.to(t.eq(2),{rotation:0,y:0,transformOrigin:"center center",duration:.3,ease:"power2.inOut"})):(r.css("display","block"),i.b.timeline().to(r,{autoAlpha:1,duration:.3,ease:"power2.inOut"}).to(n,{y:0,autoAlpha:1,duration:.5,ease:"power2.out",stagger:.1}),r.addClass("open"),i.b.to(t.eq(0),{rotation:45,y:10,transformOrigin:"center center",duration:.3,ease:"power2.inOut"}),i.b.to(t.eq(1),{autoAlpha:0,duration:.3,ease:"power2.inOut"}),i.b.to(t.eq(2),{rotation:-45,y:-10,transformOrigin:"center center",duration:.3,ease:"power2.inOut"}))}))})),this.events()},p=r(69),f=r.n(p);function y(e){return(y="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function b(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,(o=n.key,i=void 0,i=function(e,t){if("object"!==y(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var n=r.call(e,t||"default");if("object"!==y(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(o,"string"),"symbol"===y(i)?i:String(i)),n)}var o,i}var d=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.SliderSelector=document.querySelectorAll(".content-slider"),this.fullslider=document.querySelectorAll(".full-slider"),this.autoSliderLeftArrow=document.querySelectorAll(".swiper-button-prev"),this.autoSliderRighttArrow=document.querySelectorAll(".swiper-button-next"),this.i=0,this.CrouselSliderAction(),this.projectGallerySlider()}var t,r,n;return t=e,(r=[{key:"projectGallerySlider",value:function(){new f.a(".gallery-swiper",{slidesPerView:"auto",spaceBetween:10,loop:!0,speed:2e3,autoplay:{delay:3e3,disableOnInteraction:!1},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},pagination:{el:".swiper-pagination",clickable:!0}})}},{key:"CrouselSliderAction",value:function(){for(this.i=0;this.i<this.SliderSelector.length;this.i++)this.SliderSelector[this.i].classList.add("content-slider-"+this.i),new f.a(".content-slider-"+this.i,{slidesPerView:1,spaceBetween:5,autoHeight:!0,loop:!0,allowTouchMove:!0,speed:1e3,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},pagination:{el:".swiper-pagination"},breakpoints:{768:{slidesPerGroup:1,slidesPerView:4,spaceBetween:30},1200:{slidesPerView:4,spaceBetween:30,loop:!0,allowTouchMove:!0},1680:{spaceBetween:80}}})}},{key:"fullsliderSliderAction",value:function(){for(this.i=0;this.i<this.fullslider.length;this.i++)this.fullslider[this.i].classList.add("full-slider-"+this.i),this.autoSliderLeftArrow[this.i].classList.add("slider-button-next-"+this.i),this.autoSliderRighttArrow[this.i].classList.add("slider-button-prev-"+this.i),new f.a(".full-slider-"+this.i,{slidesPerView:1,spaceBetween:0,autoHeight:!0,loop:!1,allowTouchMove:!0,speed:1e3,coverflowEffect:{rotate:30,slideShadows:!1},navigation:{slidesPerView:1,prevEl:".slider-button-next-"+this.i,nextEl:".slider-button-prev-"+this.i},pagination:{el:".swiper-pagination",clickable:!0}})}}])&&b(t.prototype,r),n&&b(t,n),Object.defineProperty(t,"prototype",{writable:!1}),e}();function m(e){return(m="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function v(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,(o=n.key,i=void 0,i=function(e,t){if("object"!==m(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var n=r.call(e,t||"default");if("object"!==m(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(o,"string"),"symbol"===m(i)?i:String(i)),n)}var o,i}i.a.registerPlugin(a.a);var w=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.initParallax(),this.initScaleAnimation(),this.initHeadingAnimation()}var t,r,n;return t=e,(r=[{key:"initParallax",value:function(){i.a.to(".parallax-image",{yPercent:-20,ease:"none",scrollTrigger:{trigger:".swiper-slide",start:"top bottom",end:"bottom top",scrub:!0}})}},{key:"initScaleAnimation",value:function(){i.a.fromTo(".parallax-image",{scale:1.3},{scale:1,duration:10,ease:"power2.out"})}},{key:"initHeadingAnimation",value:function(){i.a.fromTo(".slide-heading h1 span strong",{y:"100%"},{y:"0%",duration:1.5,ease:"power2.out",stagger:.3,delay:.5})}}])&&v(t.prototype,r),n&&v(t,n),Object.defineProperty(t,"prototype",{writable:!1}),e}();document.addEventListener("DOMContentLoaded",(function(){new w}));var h=w,g=r(135),S=r.n(g);r(343);function P(e){return(P="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function O(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,(o=n.key,i=void 0,i=function(e,t){if("object"!==P(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var n=r.call(e,t||"default");if("object"!==P(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(o,"string"),"symbol"===P(i)?i:String(i)),n)}var o,i}var j=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.initGalleryPopup()}var t,r,n;return t=e,(r=[{key:"initGalleryPopup",value:function(){new S.a(".gallery-wrapper a",{captionsData:"alt",captionDelay:250,showCounter:!0,navText:["←","→"],animationSpeed:400})}}])&&O(t.prototype,r),n&&O(t,n),Object.defineProperty(t,"prototype",{writable:!1}),e}();new d,new c,new j,new h}});