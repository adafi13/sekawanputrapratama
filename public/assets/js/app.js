var MyScroll = "";
(function (window, document, $, undefined) {
  "use strict";

  // Deteksi Mobile
  var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Nokia|Opera Mini/i.test(navigator.userAgent) ? true : false;
  
  var Init = {
    i: function (e) {
      Init.s();
      Init.methods();
    },
    s: function (e) {
      (this._window = $(window)),
        (this._document = $(document)),
        (this._body = $("body")),
        (this._html = $("html"));
    },
    methods: function (e) {
      Init.w();
      Init.preloader();
      Init.header();
      Init.smoothScrollbar();
      Init.textReveal();
      Init.slick();
      Init.niceSelect();
      Init.formValidation();
      Init.contactForm();
    },

    w: function (e) {
      if (isMobile) {
        $("body").addClass("is-mobile");
      }
    },

    // 1. Preloader (Pastikan ini jalan)
    preloader: function () {
      setTimeout(function () {
        $("#preloader").fadeOut("slow");
      }, 1000);
    },

    // 2. Header
    header: function () {
      function dynamicCurrentMenuClass(selector) {
        let FileName = window.location.pathname.split("/").pop();
        selector.find("li").each(function () {
          let anchor = $(this).find("a");
          let href = $(anchor).attr("href");
          if (href == FileName) {
            $(this).addClass("current");
          }
        });
        // Handle root/index
        if (FileName == "" || FileName == "index.html") {
            selector.find("li").eq(0).addClass("current");
        }
      }

      if ($(".main-menu__list").length) {
        let mainNavUL = $(".main-menu__list");
        dynamicCurrentMenuClass(mainNavUL);
      }

      if ($(".main-menu__nav").length && $(".mobile-nav__container").length) {
        let navContent = document.querySelector(".main-menu__nav").innerHTML;
        let mobileNavContainer = document.querySelector(".mobile-nav__container");
        mobileNavContainer.innerHTML = navContent;
      }

      if ($(".mobile-nav__container .main-menu__list").length) {
        let dropdownAnchor = $(".mobile-nav__container .main-menu__list .dropdown > a");
        dropdownAnchor.each(function () {
          let self = $(this);
          let toggleBtn = document.createElement("BUTTON");
          toggleBtn.setAttribute("aria-label", "dropdown toggler");
          toggleBtn.innerHTML = "<i class='fa fa-angle-down'></i>";
          self.append(function () { return toggleBtn; });
          self.find("button").on("click", function (e) {
            e.preventDefault();
            let self = $(this);
            self.toggleClass("expanded");
            self.parent().toggleClass("expanded");
            self.parent().parent().children("ul").slideToggle();
          });
        });
      }

      if ($(".mobile-nav__toggler").length) {
        $(".mobile-nav__toggler").on("click", function (e) {
          e.preventDefault();
          $(".mobile-nav__wrapper").toggleClass("expanded");
          $("body").toggleClass("locked");
        });
        $(".mobile-nav__close").on("click", function (e) {
          e.preventDefault();
          $(".mobile-nav__wrapper").removeClass("expanded");
          $("body").removeClass("locked");
        });
      }
    },

    // 3. Smooth Scrollbar (BUG FIX DISINI)
    smoothScrollbar: function () {
      if ($("body").hasClass("tt-smooth-scroll") && !isMobile) {
        
        // Cek library
        if (typeof window.Scrollbar === 'undefined') {
            return;
        }

        var Scrollbar = window.Scrollbar;

        // Definisi Class Plugin dengan cara Aman (ES5/ES6 Standar)
        class AnchorPlugin extends Scrollbar.ScrollbarPlugin {
          onInit() {
            this.jumpToHash(window.location.hash);
            // Binding manual agar 'this' tidak error
            this.handleHashChange = this.handleHashChange.bind(this);
            window.addEventListener('hashchange', this.handleHashChange);
          }
          
          handleHashChange() {
             this.jumpToHash(window.location.hash);
          }

          jumpToHash(hash) {
            if (!hash) return;
            const { scrollbar } = this;
            scrollbar.containerEl.scrollTop = 0;
            const target = document.querySelector(hash);
            if (target) {
              scrollbar.scrollIntoView(target, {
                offsetTop: parseFloat(target.getAttribute('data-offset')) || 0
              });
            }
          }

          onDestroy() { // Typo 'onDestory' diperbaiki jadi 'onDestroy'
            window.removeEventListener('hashchange', this.handleHashChange);
          }
        }
        
        AnchorPlugin.pluginName = 'anchor'; // Definisi nama plugin

        Scrollbar.use(AnchorPlugin);
        
        if(document.querySelector("#scroll-container")) {
            Scrollbar.init(document.querySelector("#scroll-container"), {
                damping: 0.175,
                renderByPixel: true,
                continuousScrolling: true,
            });
        }

        $("input[type=number]").on("focus", function () {
          $(this).on("wheel", function (e) {
            e.stopPropagation();
          });
        });
      }
    },

    // 4. Text Reveal
    textReveal: function () {
      if ($(".text-reveal").length && document.querySelector('.random-word')) {
        let i = 0;
        const phrases = ['Web Development', 'Apps Development', 'Office Server'];
        
        const randomNum = (num, max) => {
          let j = Math.floor(Math.random() * max);
          return (num === j) ? randomNum(i, max) : j;
        }

        const randomizeText = () => {
          const phrase = document.querySelector('.random-word');
          if(!phrase) return;
          i = randomNum(i, phrases.length);
          const newPhrase = phrases[i];
          setTimeout(() => { phrase.textContent = newPhrase; }, 400); 
        }

        randomizeText();
        setInterval(randomizeText, 3000);
      }
    },

    // 5. Slick Slider
    slick: function () {
      if ($(".brand-slider").length) {
        $(".brand-slider").slick({
          infinite: true,
          slidesToShow: 6,
          arrows: false,
          autoplay: true,
          cssEase: 'linear',
          autoplaySpeed: 0,
          speed: 4000,
          pauseOnFocus: false,
          pauseOnHover: false,
          responsive: [
            { breakpoint: 1199, settings: { slidesToShow: 4 } },
            { breakpoint: 992, settings: { slidesToShow: 3 } },
            { breakpoint: 767, settings: { slidesToShow: 3 } },
            { breakpoint: 575, settings: { slidesToShow: 2 } },
          ],
        });
      };
      if ($(".team-slider").length) {
        $(".team-slider").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          variableWidth: true,
          infinite: true,
          autoplay: false,
          dots: false,
          centerMode: true,
          arrows: false,
          speed: 800,
          autoplaySpeed: 2000, 
          responsive: [
            { breakpoint: 821, settings: { variableWidth: false, centerMode: false } },
          ],
        });
      }
      if ($(".testimonials-slider").length) {
        $(".testimonials-slider").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: false,
          speed: 800,
          autoplaySpeed: 2000,
          infinite: true,
          arrows: false,
          dots: false,
        });
      }

      $(".btn-prev").click(function () {
        var $this = $(this).attr("data-slide");
        $('.' + $this).slick("slickPrev");
      });

      $(".btn-next").click(function () {
        var $this = $(this).attr("data-slide");
        $('.' + $this).slick("slickNext");
      });
    },

    // 6. Nice Select
    niceSelect: function () {
      if ($(".has-nice-select").length && $.fn.niceSelect) {
        $('.has-nice-select, .contact-form select').niceSelect();
      }
    },

    // 7. Form Validation
    formValidation: function () {
      if ($(".contact-form").length && $.fn.validate) {
        $(".contact-form").validate();
      }
    },

    // 8. Contact Form
    contactForm: function () {
      $(".contact-form").on("submit", function (e) {
        e.preventDefault();
        if ($.fn.validate && !$(".contact-form").valid()) {
            return false;
        }
        var _self = $(this);
        var btn = _self.closest("div").find('button[type="submit"]');
        btn.attr("disabled", "disabled");
        btn.find("span").text("Sending..."); 

        setTimeout(function() {
             $(".contact-form").trigger("reset");
             btn.removeAttr("disabled");
             btn.find("span").text("Submit");
             
             // Pastikan element pesan ada
             var msgBox = document.getElementById("messages");
             if(msgBox){
                 msgBox.innerHTML = "<h4 class='color-primary mt-5'>Pesan Terkirim (Demo)</h4>";
                 $("#messages").show("slow");
                 setTimeout(function () { $("#messages").hide("slow"); }, 4000);
             } else {
                 alert("Pesan Terkirim (Demo)");
             }
        }, 1000);
      });
    },
  };

  // Jalankan Init
  $(document).ready(function() {
      Init.i();
  });

})(window, document, jQuery);