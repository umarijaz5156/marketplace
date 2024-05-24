// $(function() {
//   $(window).on("scroll", function() {
//       if($(window).scrollTop() > 100) {
//           $(".header__top").addClass("nav__active");
//           $("#mega-menu-custom").removeClass("mega-menu-hide");
//       } else {
//          $(".header__top").removeClass("nav__active");
//          $("#mega-menu-custom").addClass("mega-menu-hide");
//          $("#mega-menu-full-dropdown").addClass('hidden')
//       }
//   });
// });

// // $(function(){
// //     $('#mega-menu-full-dropdown-button').on('click', function(){
// //         // $('#custom-megamenu-div').removeClass('hidden')
// //     })
// // })

// // Dahboard Table JS

// $(function(){
//   $('#toggle').on("click", () => {
//     $('#side-nav').toggleClass('sidebar-open');
//   });
//  });

//  // create an array of objects with the id, trigger element (eg. button), and the content element

//     const tabElements = [
//         {
//             id: 'profile',
//             triggerEl: document.querySelector('#profile-tab-example'),
//             targetEl: document.querySelector('#profile-example')
//         },
//         {
//             id: 'dashboard',
//             triggerEl: document.querySelector('#dashboard-tab-example'),
//             targetEl: document.querySelector('#dashboard-example')
//         },
//         {
//             id: 'settings',
//             triggerEl: document.querySelector('#settings-tab-example'),
//             targetEl: document.querySelector('#settings-example')
//         },
//       ];

//       // options with default values
//         const options = {
//         defaultTabId: 'settings',
//         activeClasses: 'text-[#2646c4] hover:text-blue-600 drk:text-blue-500 drk:hover:text-blue-400 border-[#2646c4] drk:border-blue-500',
//         inactiveClasses: 'text-gray-500 hover:text-gray-600 drk:text-gray-400 border-gray-100 hover:border-gray-300 drk:border-gray-700 drk:hover:text-gray-300',
//         onShow: () => {
//         }
//       };
//     if($("#profile-tab-example").length){
//       const tabs = new Tabs(tabElements, options);
//       // shows another tab element
//       tabs.show('dashboard');

//       // get the tab object based on ID
//       tabs.getTab('contacts')

//       // get the current active tab object
//       tabs.getActiveTab()
//     }



// // Chat App JS
// $(function(){
//   $('#collapse-sidebar').on('click', function(){
//     $('.leftbar').toggleClass('leftbar-collapse')
//   })
// })
// $(function(){
//   $('#close-sidebar').on('click', function(){
//     $('.leftbar').toggleClass('leftbar-collapse')
//   })
// })
// // Chat App JS

//       const prevBtns = document.querySelectorAll(".btn-prev");
//       const nextBtns = document.querySelectorAll(".btn-next");
//       const progress = document.getElementById("progress");
//       const formSteps = document.querySelectorAll(".form-step");
//       const progressSteps = document.querySelectorAll(".progress-step");

//       let formStepsNum = 0;

//       nextBtns.forEach((btn) => {
//         btn.addEventListener("click", () => {

//             formStepsNum++;
//             updateFormSteps();
//             updateProgressbar();
//         // }
//         });
//       });

//       prevBtns.forEach((btn) => {
//         btn.addEventListener("click", () => {

//             formStepsNum--;
//             updateFormSteps();
//             updateProgressbar();


//         });
//       });

//       function updateFormSteps() {
//         formSteps.forEach((formStep) => {
//           formStep.classList.contains("form-step-active") &&
//             formStep.classList.remove("form-step-active");
//         });

//         formSteps[formStepsNum].classList.add("form-step-active");
//       }

//       function updateProgressbar() {
//         progressSteps.forEach((progressStep, idx) => {
//           if (idx < formStepsNum + 1) {
//             progressStep.classList.add("progress-step-active");
//           } else {
//             progressStep.classList.remove("progress-step-active");
//           }
//         });

//         const progressActive = document.querySelectorAll(".progress-step-active");

//         progress.style.width =
//           ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
//       }


      const setup = () => {
        function getSidebarStateFromLocalStorage() {
          return false;
        }

        return {
          loading: true,
          isSidebarOpen: getSidebarStateFromLocalStorage(),
          toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen;
          },
          isSettingsPanelOpen: false,
          isSearchBoxOpen: false,
        };
      };
      function app() {
        return {
          isOpen: false,
          colors: [
            "#2196F3",
            "#009688",
            "#9C27B0",
            "#FFEB3B",
            "#afbbc9",
            "#4CAF50",
            "#2d3748",
            "#f56565",
            "#ed64a6",
          ],
          colorSelected: "#2196F3",
        };
      }

      $(function () {
        $('input[name="datetimes"]').daterangepicker({
          timePicker: true,
          startDate: moment().startOf("hour"),
          endDate: moment().startOf("hour").add(32, "hour"),
          locale: {
            format: "M/DD hh:mm A",
          },
        });
      });

      // Custom select Dropdown Js
      if (document.querySelectorAll(".wrapper-dropdown")) {
        const selectedAll = document.querySelectorAll(".wrapper-dropdown");

        selectedAll.forEach((selected) => {
          const optionsContainer = selected.children[2];
          const optionsList = selected.querySelectorAll("div.wrapper-dropdown li");

          selected.addEventListener("click", () => {
            let arrow = selected.children[1];

            if (selected.classList.contains("active")) {
              handleDropdown(selected, arrow, false);
            } else {
              let currentActive = document.querySelector(".wrapper-dropdown.active");

              if (currentActive) {
                let anotherArrow = currentActive.children[1];
                handleDropdown(currentActive, anotherArrow, false);
              }

              handleDropdown(selected, arrow, true);
            }
          });

          // update the display of the dropdown
          for (let o of optionsList) {
            o.addEventListener("click", () => {
              selected.querySelector(".selected-display").innerHTML = o.innerHTML;
            });
          }
        });

        // check if anything else ofther than the dropdown is clicked
        window.addEventListener("click", function (e) {
          if (e.target.closest(".wrapper-dropdown") === null) {
            closeAllDropdowns();
          }
        });

        // close all the dropdowns
        function closeAllDropdowns() {
          const selectedAll = document.querySelectorAll(".wrapper-dropdown");
          selectedAll.forEach((selected) => {
            const optionsContainer = selected.children[2];
            let arrow = selected.children[1];

            handleDropdown(selected, arrow, false);
          });
        }

        // open all the dropdowns
        function handleDropdown(dropdown, arrow, open) {
          if (open) {
            arrow.classList.add("rotated");
            dropdown.classList.add("active");
          } else {
            arrow.classList.remove("rotated");
            dropdown.classList.remove("active");
          }
        }
      }

      var swiper = new Swiper(".mySwiperTestimonial", {
        spaceBetween: 52,
        slidesPerView: 1,
        navigation: {
          prevEl: ".slidePrev-btn",
          nextEl: ".slideNext-btn",
        },
      });
      var swiper2 = new Swiper(".swiperReview", {
        slidesPerView: 1,
        navigation: {
          prevEl: ".slidePrev-btn1",
          nextEl: ".slideNext-btn1",
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
        },
      });

      var swiper3 = new Swiper(".swiperCompanies", {
        slidesPerView: 1,
        navigation: {
          prevEl: ".slidePrev-btn2",
          nextEl: ".slideNext-btn2",
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
        },
      });

      var swiper = new Swiper(".mySpecialServices", {
        spaceBetween: 52,
        slidesPerView: 1,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
        },
      });

      var portfolio = new Swiper(".sellerPortfolio", {
        spaceBetween: 52,
        slidesPerView: 1,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
        },
      });

      var swiper4 = new Swiper(".myClientsReview", {
        spaceBetween: 52,
        slidesPerView: 1,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
        },
      });

      var swiper5 = new Swiper(".myReviews", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        navigation: {
          prevEl: ".reviewsPrev",
          nextEl: ".reviewsNext",
        },
      });

      var swiper6 = new Swiper(".single-product-page", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        // Navigation arrows
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

