$(function(){$("#toggle").on("click",()=>{$("#side-nav").toggleClass("sidebar-open")})});$(function(){$(window).on("scroll",function(){$(window).scrollTop()>100?($(".header__top").addClass("nav__active"),$("#mega-menu-custom").removeClass("mega-menu-hide")):($(".header__top").removeClass("nav__active"),$("#mega-menu-custom").addClass("mega-menu-hide"),$("#mega-menu-full-dropdown").addClass("hidden"))})});$(document).ready(function(){$(".gig-images").slick({infinite:!0,slidesToShow:3,slidesToScroll:1,dots:!1,autoplay:!0,autoplaySpeed:2e3,arrows:!1})});document.querySelector(".testimonial-swiper2")&&new Swiper(".testimonial-swiper2",{loop:!1,slidesPerView:1,spaceBetween:10,autoHeight:!0,navigation:{prevEl:".slidePrev-btn",nextEl:".slideNext-btn"},breakpoints:{640:{slidesPerView:2,spaceBetween:10},640:{slidesPerView:2,spaceBetween:10},768:{slidesPerView:3,spaceBetween:20},1024:{slidesPerView:5,spaceBetween:30}}});document.querySelector(".explore-marketplace-slider")&&$(document).ready(function(){$(".explore-marketplace-slider").slick({infinite:!0,slidesToShow:3,slidesToScroll:1,dots:!1,autoplay:!0,autoplaySpeed:2e3,arrows:!1,responsive:[{breakpoint:768,settings:{slidesToShow:3}},{breakpoint:480,settings:{slidesToShow:1}}]})});document.querySelector(".popular-services-slider")&&$(document).ready(function(){$(".popular-services-slider").slick({infinite:!0,slidesToShow:4,slidesToScroll:1,dots:!1,autoplay:!0,autoplaySpeed:2e3,prevArrow:$(".pp-prev"),nextArrow:$(".pp-next"),responsive:[{breakpoint:1450,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:2}},{breakpoint:767,settings:{slidesToShow:1}}]})});document.querySelector(".videoad-services-slider")&&$(document).ready(function(){$(".videoad-services-slider").slick({infinite:!0,slidesToShow:4,slidesToScroll:1,dots:!1,autoplay:!0,autoplaySpeed:2e3,prevArrow:$(".pp-prev2"),nextArrow:$(".pp-next2"),responsive:[{breakpoint:1450,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:2}},{breakpoint:767,settings:{slidesToShow:1}}]})});document.querySelector(".store-services-slider")&&$(document).ready(function(){$(".store-services-slider").slick({infinite:!0,slidesToShow:4,slidesToScroll:1,dots:!1,autoplay:!0,autoplaySpeed:2e3,prevArrow:$(".pp-prev3"),nextArrow:$(".pp-next3"),responsive:[{breakpoint:1450,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:2}},{breakpoint:767,settings:{slidesToShow:1}}]})});document.querySelector(".freelance-slider")&&$(document).ready(function(){$(".freelance-slider").slick({infinite:!0,slidesToShow:4,slidesToScroll:1,dots:!1,autoplay:!0,autoplaySpeed:2e3,centerMode:!0,arrows:!1,responsive:[{breakpoint:1450,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:2}},{breakpoint:767,settings:{slidesToShow:1}}]})});$(".bussiness-team-slider").slick({slidesToShow:1,slidesToScroll:1,arrows:!1,fade:!0,asNavFor:".bottom-bussiness-team"});$(".bottom-bussiness-team").slick({slidesToShow:4,slidesToScroll:1,asNavFor:".bussiness-team-slider",focusOnSelect:!0,arrows:!1,autoplay:!0,centerMode:!0,responsive:[{breakpoint:992,settings:{slidesToShow:4}},{breakpoint:800,settings:{slidesToShow:3}},{breakpoint:480,settings:{centerMode:!1,autoplay:!0,slidesToShow:2}}]});$(document).ready(function(){$(".testimonial-sider").slick({infinite:!0,slidesToShow:1,slidesToScroll:1,dots:!1,autoplay:!0,autoplaySpeed:2e3,arrows:!1,responsive:[{breakpoint:1450,settings:{slidesToShow:1}},{breakpoint:991,settings:{slidesToShow:1}},{breakpoint:767,settings:{slidesToShow:1}}]})});$(document).ready(function(){$("#attachmentTable").DataTable({responsive:!1,searching:!1,info:!1,sorting:!1,lengthChange:!1,paginate:!1,ordering:!1})});const o=[{id:"profile",triggerEl:document.querySelector("#profile-tab-example"),targetEl:document.querySelector("#profile-example")},{id:"dashboard",triggerEl:document.querySelector("#dashboard-tab-example"),targetEl:document.querySelector("#dashboard-example")},{id:"settings",triggerEl:document.querySelector("#settings-tab-example"),targetEl:document.querySelector("#settings-example")}],r={defaultTabId:"settings",activeClasses:"text-[#2646c4] hover:text-blue-600 drk:text-blue-500 drk:hover:text-blue-400 border-[#2646c4] drk:border-blue-500",inactiveClasses:"text-gray-500 hover:text-gray-600 drk:text-gray-400 border-gray-100 hover:border-gray-300 drk:border-gray-700 drk:hover:text-gray-300",onShow:()=>{}};if($("#profile-tab-example").length){const e=new Tabs(o,r);e.show("dashboard"),e.getTab("contacts"),e.getActiveTab()}$(function(){$("#collapse-sidebar").on("click",function(){$(".leftbar").toggleClass("leftbar-collapse")})});$(function(){$("#close-sidebar").on("click",function(){$(".leftbar").toggleClass("leftbar-collapse")})});document.querySelectorAll(".btn-prev");document.querySelectorAll(".btn-next");document.getElementById("progress");document.querySelectorAll(".form-step");document.querySelectorAll(".progress-step");$(document).ready(function(){$(".become-seller-slider").slick({infinite:!0,slidesToShow:4,slidesToScroll:1,centerMode:!1,dots:!1,autoplay:!1,autoplaySpeed:2e3,prevArrow:$(".pp-prev"),nextArrow:$(".pp-next"),responsive:[{breakpoint:1500,settings:{slidesToShow:3}},{breakpoint:1280,settings:{slidesToShow:4}},{breakpoint:1024,settings:{slidesToShow:3}},{breakpoint:768,settings:{slidesToShow:2}},{breakpoint:600,settings:{slidesToShow:1}}]})});new Swiper(".testimonial-swiper",{direction:"horizontal",loop:!0,autoHeight:!0,navigation:{prevEl:".slidePrev-btn",nextEl:".slideNext-btn"}});new Swiper(".seller-testimonial-swiper",{direction:"horizontal",loop:!0,autoHeight:!0,spaceBetween:31,centeredSlides:!0,slidesPerView:1,pagination:{el:".swiper-pagination-seller"},navigation:{prevEl:".slidePrev-btn1",nextEl:".slideNext-btn1"},breakpoints:{768:{slidesPerView:2},1024:{slidesPerView:3},1280:{slidesPerView:4}}});new Swiper(".single-product-page-v2",{direction:"horizontal",loop:!0,autoHeight:!0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"}});var t=new Swiper(".growing-slider",{direction:"horizontal",loop:!0,autoHeight:!0,pagination:{el:".swiper-pagination"}}),t=new Swiper(".mySwiper",{loop:!1,spaceBetween:10,slidesPerView:3,freeMode:!0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},watchSlidesProgress:!0,breakpoints:{768:{slidesPerView:4,spaceBetween:20}}});new Swiper(".mySwiper2",{loop:!0,spaceBetween:20,thumbs:{swiper:t}});if(document.querySelector("#general-tab-example")){const e=[{id:"general",triggerEl:document.querySelector("#general-tab-example"),targetEl:document.querySelector("#general-example")},{id:"password",triggerEl:document.querySelector("#password-tab-example"),targetEl:document.querySelector("#password-example")},,{id:"billing",triggerEl:document.querySelector("#billing-tab-example"),targetEl:document.querySelector("#billing-example")}],s={defaultTabId:"general",activeClasses:"text-[#3E47DD] hover:text-blue-600 drk:text-blue-500 drk:hover:text-blue-400 border-[#3E47DD]",inactiveClasses:"text-[#586487] hover:text-gray-600 drk:text-gray-400 border-transparent hover:border-gray-300 drk:border-gray-700 drk:hover:text-gray-300",onShow:()=>{console.log("tab is shown")}};new Tabs(e,s)}var t=new Swiper(".portfolioSlider",{loop:!1,spaceBetween:10,slidesPerView:2,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},breakpoints:{640:{slidesPerView:3,spaceBetween:20},768:{slidesPerView:4,spaceBetween:20}}});
