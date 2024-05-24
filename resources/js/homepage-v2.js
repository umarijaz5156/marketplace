
// if(document.querySelector(".gallery-filter")){
//     const filterContainer = document.querySelectorAll(".gallery-filter"),
//     galleryItems = document.querySelectorAll(".gallery-item");
//     let filterDots = document.querySelectorAll('.filter-dots')
//     filterContainer.forEach((item)=> (
//       item.addEventListener("click", (event) =>{
//         if(event.target.classList.contains("filter-item")){

//           item.querySelector(".active").classList.remove("active");
//           filterDots.forEach((item)=>(
//             item.classList.remove('filter-active-dot')
//           ))

//           event.target.classList.add("active");
//           const filterValue = event.target.getAttribute("data-filter");
//           if(item.classList.contains(filterValue) || filterValue === 'Professional'){
//             let professioalDot =document.querySelector('.filter-item-professional')
//             professioalDot.classList.add('filter-active-dot')
//           }else if(item.classList.contains(filterValue) || filterValue === 'dropshipping'){
//             let dropshippingDot =document.querySelector('.filter-item-dropshipping')
//             dropshippingDot.classList.add('filter-active-dot')
//           }else if(item.classList.contains(filterValue) || filterValue === 'video'){
//             let videoDot =document.querySelector('.filter-item-video')
//             videoDot.classList.add('filter-active-dot')
//           }else{
//             let allDot =document.querySelector('.filter-item-all')
//             allDot.classList.add('filter-active-dot')
//           }
//           galleryItems.forEach((item) =>{
//             if(item.classList.contains(filterValue) || filterValue === 'all'){
//                 item.classList.remove("hide");
//                 item.classList.add("show");
//             }else{
//                 item.classList.remove("show");
//                 item.classList.add("hide");
//             }
//           });
//         }
//       })
//     ))
//   }

  // var swiper = new Swiper('.swiper', {
  //   loop: true,
  //   pagination: '.swiper-pagination',
  //   centeredSlides: false,
  //   spaceBetween : 5,
  //   slidesPerView: 1,
  //   breakpoints :{
  //     768:{
  //       spaceBetween : 40,
  //       slidesPerView: 4,
  //     }
  //   }
  // });

  const swipy = new Swiper(".service-slider", {
    // Optional parameters
    loop: true,
    spaceBetween: 30,
    slidesPerView: 1,
    // Navigation arrows
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
      1280: {
        slidesPerView: 4,
      },
    },
  });
  const swipy2 = new Swiper(".category-slider", {
    // Optional parameters
    loop: true,
    spaceBetween: 30,
    slidesPerView: 1,
    // Navigation arrows
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
      1280: {
        slidesPerView: 4,
      },
    },
  });
  const swiper1 = new Swiper(".testimonial-slider", {
    // Optional parameters
    loop: true,
    slidesPerView: 1,
    // Navigation arrows
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1280: {
        slidesPerView: 3,
      },
    },
    // Navigation arrows
    navigation: {
      prevEl: ".slidePrev-btn",
      nextEl: ".slideNext-btn",
    },
  });

