/* ----------------------------------------------------------------

[ Custom settings ]

01. ScrollIt
02. Preloader
03. Navbar scrolling background
04. Close navbar-collapse when a clicked
05. Sections background image from data background
06. Slider-Fade owlCarousel
07. Services 1 owlCarousel
08. Services 2 owlCarousel
09. Services Single owlCarousel
10. Blog owlCarousel 
11. Team owlCarousel 
12. Clients owlCarousel
13. Testimonials owlCarousel
14. MagnificPopup
15. Accordion
16. Isotope Active Masonry Gallery
17. Animations
18. YouTubePopUp
19. Parallaxie
20. Tooltip
21. Wow Animated
22. Splitting Text
23. Reveal Effect
24. Magnet Cursor
25. Mouse Cursor
26. Scroll back to top
27. Contact Form

------------------------------------------------------------------- */

(function () {
  "use strict";
  var wind = $(window);
  // ScrollIt
  $.scrollIt({
    upKey: 38, // key code to navigate to the next section
    downKey: 40, // key code to navigate to the previous section
    easing: "swing", // the easing function for animation
    scrollTime: 600, // how long (in ms) the animation takes
    activeClass: "active", // class given to the active nav element
    onPageChange: null, // function(pageIndex) that is called when page is changed
    topOffset: -70, // offste (in px) for fixed top navigation
  });

  // Preloader
  $(".preloader").fadeOut(400);
  $(".preloader-bg").delay(300).fadeOut(400);
  var wind = $(window);

  // Navbar scrolling background
  wind.on("scroll", function () {
    var bodyScroll = wind.scrollTop(),
      navbar = $(".navbar"),
      logo = $(".navbar .logo> img");
    if (bodyScroll > 100) {
      navbar.addClass("nav-scroll");
      logo.attr("src", "images/mah_logo.png");
    } else {
      navbar.removeClass("nav-scroll");
      logo.attr("src", "images/mah_logo.png");
    }
  });

  // Close navbar-collapse when a clicked
  $(".navbar-nav .dropdown-item a").on("click", function () {
    $(".navbar-collapse").removeClass("show");
  });

  // Sections background image from data background
  var pageSection = $(".bg-img, section");
  pageSection.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css(
        "background-image",
        "url(" + $(this).data("background") + ")"
      );
    }
  });

  // Slider-Fade owlCarousel
  var owl = $(".header .owl-carousel");
  $(".slider-fade .owl-carousel").owlCarousel({
    items: 1,
    loop: true,
    dots: true,
    margin: 0,
    autoplay: false,
    autoplayTimeout: 5000,
    animateOut: "fadeOut",
    nav: true,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
  });
  owl.on("changed.owl.carousel", function (event) {
    var item = event.item.index - 2; // Position of the current item
    $("h6").removeClass("animated fadeInUp");
    $("h1").removeClass("animated fadeInUp");
    $("p").removeClass("animated fadeInUp");
    $(".btn-wrap").removeClass("animated fadeInUp");
    $(".btn-wrap2").removeClass("animated fadeInUp");
    $(".owl-item")
      .not(".cloned")
      .eq(item)
      .find("h6")
      .addClass("animated fadeInUp");
    $(".owl-item")
      .not(".cloned")
      .eq(item)
      .find("h1")
      .addClass("animated fadeInUp");
    $(".owl-item")
      .not(".cloned")
      .eq(item)
      .find("p")
      .addClass("animated fadeInUp");
    $(".owl-item")
      .not(".cloned")
      .eq(item)
      .find(".btn-wrap")
      .addClass("animated fadeInUp");
    $(".owl-item")
      .not(".cloned")
      .eq(item)
      .find(".btn-wrap2")
      .addClass("animated fadeInUp");
  });

  // Services 1 owlCarousel
  $(".services .owl-carousel").owlCarousel({
    loop: true,
    margin: 15,
    mouseDrag: true,
    autoplay: false,
    autoplayTimeout: 5000,
    dots: false,
    autoplayHoverPause: true,
    nav: false,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        dots: true,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  // Services 2 owlCarousel
  $(".services2 .owl-carousel").owlCarousel({
    loop: true,
    margin: 15,
    mouseDrag: true,
    autoplay: false,
    autoplayTimeout: 5000,
    dots: false,
    autoplayHoverPause: true,
    nav: false,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  // Services Single owlCarousel
  $(".services-page .owl-carousel").owlCarousel({
    loop: true,
    margin: 15,
    mouseDrag: true,
    autoplay: false,
    autoplayTimeout: 5000,
    dots: false,
    nav: false,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 1,
      },
    },
  });

  // Blog owlCarousel
  $(".blog-home .owl-carousel").owlCarousel({
    loop: true,
    margin: 15,
    mouseDrag: true,
    autoplay: false,
    autoplayTimeout: 5000,
    dots: false,
    nav: false,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
    autoplayHoverPause: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        dots: true,
      },
      600: {
        items: 2,
        dots: true,
      },
      1000: {
        items: 3,
      },
    },
  });

  // Team owlCarousel
  $(".team .owl-carousel").owlCarousel({
    loop: true,
    margin: 15,
    mouseDrag: true,
    autoplay: false,
    autoplayTimeout: 5000,
    dots: false,
    nav: false,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
    autoplayHoverPause: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  // Clients owlCarousel
  $(".clients .owl-carousel").owlCarousel({
    loop: true,
    margin: 15,
    mouseDrag: true,
    autoplay: true,
    autoplayTimeout: 3000,
    dots: false,
    nav: false,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        margin: 15,
        items: 3,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 4,
      },
    },
  });

  // Testimonials owlCarousel
  $(".testimonials .owl-carousel").owlCarousel({
    loop: true,
    margin: 30,
    mouseDrag: true,
    autoplay: false,
    autoplayTimeout: 7000,
    dots: false,
    nav: false,
    navText: [
      '<i class="fa-light fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa-light fa-angle-right" aria-hidden="true"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 1,
      },
    },
  });

  // MagnificPopup
  $(".img-zoom").magnificPopup({
    type: "image",
    closeOnContentClick: !0,
    mainClass: "mfp-fade",
    gallery: {
      enabled: !0,
      navigateByImgClick: !0,
      preload: [0, 1],
    },
  });
  $(".magnific-youtube, .magnific-vimeo, .magnific-custom").magnificPopup({
    disableOn: 700,
    type: "iframe",
    mainClass: "mfp-fade",
    removalDelay: 300,
    preloader: false,
    fixedContentPos: false,
  });

  // Accordion
  if ($(".accordion-box").length) {
    $(".accordion-box").on("click", ".acc-btn", function () {
      var outerBox = $(this).parents(".accordion-box");
      var target = $(this).parents(".accordion");

      if ($(this).next(".acc-content").is(":visible")) {
        //return false;
        $(this).removeClass("active");
        $(this).next(".acc-content").slideUp(300);
        $(outerBox).children(".accordion").removeClass("active-block");
      } else {
        $(outerBox).find(".accordion .acc-btn").removeClass("active");
        $(this).addClass("active");
        $(outerBox).children(".accordion").removeClass("active-block");
        $(outerBox).find(".accordion").children(".acc-content").slideUp(300);
        target.addClass("active-block");
        $(this).next(".acc-content").slideDown(300);
      }
    });
  }

  // Isotope Active Masonry Gallery
  $(".gallery-items").imagesLoaded(function () {
    // Add isotope on click filter function
    $(".gallery-filter li").on("click", function () {
      $(".gallery-filter li").removeClass("active");
      $(this).addClass("active");
      var selector = $(this).attr("data-filter");
      $(".gallery-items").isotope({
        filter: selector,
        animationOptions: {
          duration: 750,
          easing: "linear",
          queue: false,
        },
      });
      return false;
    });
    $(".gallery-items").isotope({
      itemSelector: ".single-item",
      layoutMode: "masonry",
    });
  });

  // Animations
  var contentWayPoint = function () {
    var i = 0;
    $(".animate-box").waypoint(
      function (direction) {
        if (direction === "down" && !$(this.element).hasClass("animated")) {
          i++;
          $(this.element).addClass("item-animate");
          setTimeout(function () {
            $("body .animate-box.item-animate").each(function (k) {
              var el = $(this);
              setTimeout(
                function () {
                  var effect = el.data("animate-effect");
                  if (effect === "fadeIn") {
                    el.addClass("fadeIn animated");
                  } else if (effect === "fadeInLeft") {
                    el.addClass("fadeInLeft animated");
                  } else if (effect === "fadeInRight") {
                    el.addClass("fadeInRight animated");
                  } else {
                    el.addClass("fadeInUp animated");
                  }
                  el.removeClass("item-animate");
                },
                k * 200,
                "easeInOutExpo"
              );
            });
          }, 100);
        }
      },
      {
        offset: "85%",
      }
    );
  };
  $(function () {
    contentWayPoint();
  });

  // YouTubePopUp
  $("a.vid").YouTubePopUp();

  // Parallaxie
  $(".parallaxie").parallaxie({
    speed: 0.2,
    size: "cover",
  });

  // Tooltip
  $("[data-tooltip-tit]")
    .hover(
      function () {
        $('<div class="div-tooltip-tit"></div>')
          .text($(this).attr("data-tooltip-tit"))
          .appendTo("body")
          .fadeIn("slow");
      },
      function () {
        $(".div-tooltip-tit").remove();
      }
    )
    .mousemove(function (e) {
      $(".div-tooltip-tit").css({ top: e.pageY + 10, left: e.pageX + 20 });
    });
  $("[data-tooltip-sub]")
    .hover(
      function () {
        $('<div class="div-tooltip-sub"></div>')
          .text($(this).attr("data-tooltip-sub"))
          .appendTo("body")
          .fadeIn("slow");
      },
      function () {
        $(".div-tooltip-sub").remove();
      }
    )
    .mousemove(function (e) {
      $(".div-tooltip-sub").css({ top: e.pageY + 60, left: e.pageX + 20 });
    });

  // Wow Animated
  var wow = new WOW({
    animateClass: "animated",
    offset: 100,
  });
  wow.init();

  // Splitting Text
  $(window).on("load", function () {
    Splitting();
  });

  // Reveal Effect
  var scroll =
    window.requestAnimationFrame ||
    // IE Fallback
    function (callback) {
      window.setTimeout(callback, 3000);
    };
  var elementsToShow = document.querySelectorAll(".reveal-effect");
  function loop() {
    Array.prototype.forEach.call(elementsToShow, function (element) {
      if (isElementInViewport(element)) {
        element.classList.add("animated");
      }
    });
    scroll(loop);
  }
  // Call the loop for the first time
  loop();
  // Helper function from: http://stackoverflow.com/a/7557433/274826
  function isElementInViewport(el) {
    // special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
      el = el[0];
    }
    var rect = el.getBoundingClientRect();
    return (
      (rect.top <= 0 && rect.bottom >= 0) ||
      (rect.bottom >=
        (window.innerHeight || document.documentElement.clientHeight) &&
        rect.top <=
          (window.innerHeight || document.documentElement.clientHeight)) ||
      (rect.top >= 0 &&
        rect.bottom <=
          (window.innerHeight || document.documentElement.clientHeight))
    );
  }

  // Magnet Cursor
  function magnetize(el, e) {
    var mX = e.pageX,
      mY = e.pageY;
    const item = $(el);
    const customDist = item.data("dist") * 20 || 80;
    const centerX = item.offset().left + item.width() / 2;
    const centerY = item.offset().top + item.height() / 2;
    var deltaX = Math.floor(centerX - mX) * -0.35;
    var deltaY = Math.floor(centerY - mY) * -0.35;
    var distance = calculateDistance(item, mX, mY);
    if (distance < customDist) {
      TweenMax.to(item, 0.5, {
        y: deltaY,
        x: deltaX,
        scale: 1,
      });
      item.addClass("magnet");
    } else {
      TweenMax.to(item, 0.6, {
        y: 0,
        x: 0,
        scale: 1,
      });
      item.removeClass("magnet");
    }
  }
  function calculateDistance(elem, mouseX, mouseY) {
    return Math.floor(
      Math.sqrt(
        Math.pow(mouseX - (elem.offset().left + elem.width() / 2), 2) +
          Math.pow(mouseY - (elem.offset().top + elem.height() / 2), 2)
      )
    );
  }
  function lerp(a, b, n) {
    return (1 - n) * a + n * b;
  }

  // Mouse Cursor
  class Cursor {
    constructor() {
      this.bind();
      //seleziono la classe del cursore
      this.cursor = document.querySelector(".js-cursor");

      this.mouseCurrent = {
        x: 0,
        y: 0,
      };

      this.mouseLast = {
        x: this.mouseCurrent.x,
        y: this.mouseCurrent.y,
      };

      this.rAF = undefined;
    }

    bind() {
      ["getMousePosition", "run"].forEach(
        (fn) => (this[fn] = this[fn].bind(this))
      );
    }

    getMousePosition(e) {
      this.mouseCurrent = {
        x: e.clientX,
        y: e.clientY,
      };
    }

    run() {
      this.mouseLast.x = lerp(this.mouseLast.x, this.mouseCurrent.x, 0.2);
      this.mouseLast.y = lerp(this.mouseLast.y, this.mouseCurrent.y, 0.2);

      this.mouseLast.x = Math.floor(this.mouseLast.x * 100) / 100;
      this.mouseLast.y = Math.floor(this.mouseLast.y * 100) / 100;

      this.cursor.style.transform = `translate3d(${this.mouseLast.x}px, ${this.mouseLast.y}px, 0)`;

      this.rAF = requestAnimationFrame(this.run);
    }

    requestAnimationFrame() {
      this.rAF = requestAnimationFrame(this.run);
    }

    addEvents() {
      window.addEventListener("mousemove", this.getMousePosition, false);
    }

    on() {
      this.addEvents();

      this.requestAnimationFrame();
    }

    init() {
      this.on();
    }
  }
  if ($(".js-cursor").length > 0) {
    const cursor = new Cursor();
    cursor.init();
    // Cursor Conditions
    $(
      ".blog-home .owl-theme .item, .team .owl-theme .item, .services .owl-theme .item, .services2 .owl-theme .item, .testimonials .item, .gallery-item .item"
    ).hover(function () {
      $(".cursor").toggleClass("drag");
    });
    // Cursor Class Settings
    // $('a, ').hover(function () {
    // $('.cursor').toggleClass('light');
    // });
  }

  // Scroll back to top
  var progressPath = document.querySelector(".progress-wrap path");
  var pathLength = progressPath.getTotalLength();
  progressPath.style.transition = progressPath.style.WebkitTransition = "none";
  progressPath.style.strokeDasharray = pathLength + " " + pathLength;
  progressPath.style.strokeDashoffset = pathLength;
  progressPath.getBoundingClientRect();
  progressPath.style.transition = progressPath.style.WebkitTransition =
    "stroke-dashoffset 10ms linear";
  var updateProgress = function () {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength) / height;
    progressPath.style.strokeDashoffset = progress;
  };
  updateProgress();
  $(window).scroll(updateProgress);
  var offset = 150;
  var duration = 550;
  jQuery(window).on("scroll", function () {
    if (jQuery(this).scrollTop() > offset) {
      jQuery(".progress-wrap").addClass("active-progress");
    } else {
      jQuery(".progress-wrap").removeClass("active-progress");
    }
  });
  jQuery(".progress-wrap").on("click", function (event) {
    event.preventDefault();
    jQuery("html, body").animate(
      {
        scrollTop: 0,
      },
      duration
    );
    return false;
  });

  // Contact Form
  var form = $(".contact__form"),
    message = $(".contact__msg"),
    form_data;
  // success function
  function done_func(response) {
    message.fadeIn().removeClass("alert-danger").addClass("alert-success");
    message.text(response);
    setTimeout(function () {
      message.fadeOut();
    }, 2000);
    form.find('input:not([type="submit"]), textarea').val("");
  }
  // fail function
  function fail_func(data) {
    message.fadeIn().removeClass("alert-success").addClass("alert-success");
    message.text(data.responseText);
    setTimeout(function () {
      message.fadeOut();
    }, 2000);
  }
  form.submit(function (e) {
    e.preventDefault();
    form_data = $(this).serialize();
    $.ajax({
      type: "POST",
      url: form.attr("action"),
      data: form_data,
    })
      .done(done_func)
      .fail(fail_func);
  });
})();

// slider-page-custom script
$(document).ready(function () {
  if ($("#kenburnsSliderContainer").length) {
    $("#kenburnsSliderContainer").vegas({
      slides: [
        {
          src: "images/slider/3.jpg",
        },
        {
          src: "images/slider/2.jpg",
        },
        {
          src: "images/slider/1.jpg",
        },
        {
          src: "images/slider/4.jpg",
        },
      ],
      overlay: true,
      transition: "fade2",
      animation: "kenburnsUpRight",
      transitionDuration: 1000,
      delay: 10000,
      animationDuration: 20000,
    });
  }
});




//making the alert boxes disappear on click

document.querySelectorAll('.alert').forEach(function(element) {
  element.addEventListener('click', function() {
      element.style.display = 'none';
  });
});