jQuery(function () {
   "use strict";

   $(function () {
      $(document).on("click", ".toggle", function () {
         showNavDrawer();
         $(this).toggleClass("change");
      });
      $(window).width(function () {
         sideNav();
      });
      $(window).resize(function () {
         sideNav();
      });
      $("nav .overlay").click(function () {
         $("nav .navigation-list").toggleClass("nav-collsaped");
         $("nav .overlay").toggleClass("body-overlay");
         $(".toggle").removeClass("change");
      });
      function sideNav() {
         if ($(window).width() <= 767) {
         } else {
            $("nav .navigation-list").removeClass("nav-collsaped");
            $("nav .overlay").removeClass("body-overlay");
            $(".toggle").removeClass("change");
         }
      }
      function showNavDrawer() {
         $("nav .navigation-list").toggleClass("nav-collsaped");
         $("nav .overlay").toggleClass("body-overlay");
      }

      $(window).scroll(function () {
         if ($(this).scrollTop() > 500) {
            $("#header").addClass("fixed-me");
         } else {
            $("#header").removeClass("fixed-me");
         }
      });
   });

   $(document).on("click", ".switch", function () {
      $(".request_callback").toggleClass("collapsed");
      $(".rc_trigger").toggleClass("hide");
   });

   $(document).on("click", "li.with_dropdown a", function () {
      $(this).toggleClass("active");
   });

   $("#header").load("header.html");
   $("#footer").load("footer.html");
});

function addAnimationToElements() {
   // Get all elements with the class names flex-row and scroll-wrapper
   const flexRows = document.querySelectorAll(".flex-row");
   const scrollWrappers = document.querySelectorAll(".scroll-wrapper");

   // Loop through each pair of flex-row and scroll-wrapper elements
   for (let i = 0; i < Math.min(flexRows.length, scrollWrappers.length); i++) {
      const flexRow = flexRows[i];
      const scrollWrapper = scrollWrappers[i];

      // Get the width of the flex row and scroll wrapper
      const flexRowWidth = flexRow.offsetWidth;
      const scrollWrapperWidth = scrollWrapper.offsetWidth;

      // Check if the flex row has an opposite class
      const isOpposite = flexRow.classList.contains("opposite");

      // Calculate the value for the translation
      let translationValue = -scrollWrapperWidth + flexRowWidth;
      if (isOpposite) {
         translationValue = scrollWrapperWidth - flexRowWidth;
      }

      // Create and append the style element

      const style = document.createElement("style");
      style.innerHTML = `
          @keyframes move_${i} {
              0% {
                  transform: translateX(0%);
              }
              100% {
                  transform: translateX(${translationValue}px);
              }
          }
      `;
      document.head.appendChild(style);

      // Apply the animation to the scroll wrapper
      scrollWrapper.style.animation = `move_${i} 12s linear infinite alternate`; // Adjust the duration and timing function as needed
   }
}
addAnimationToElements();

// svg heading anim

function observeSections(className, inViewClass, options) {
   const sections = document.querySelectorAll(`.${className}`);

   const defaultOptions = {
      root: null,
      rootMargin: "0px",
      threshold: 0.1,
   };

   const mergedOptions = { ...defaultOptions, ...options };

   const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
         if (entry.isIntersecting) {
            entry.target.classList.add(inViewClass);
         } else {
            entry.target.classList.remove(inViewClass);
         }
      });
   }, mergedOptions);

   sections.forEach((section) => {
      observer.observe(section);
   });
}
// observeSections("sec-heading", "in-view", { threshold: 1 });
observeSections("i-text", "in-view", { threshold: 1 });
// observeSections("animated-heading", "in-view", { threshold: 1 });
observeSections('s-card', "in-view", { threshold: 0.3 })



// process anim
function processLine(className, inViewClass, options) {
   const sections = document.querySelectorAll(`.${className}`);

   const defaultOptions = {
      root: null,
      rootMargin: "0px",
      threshold: 0.1,
   };

   const mergedOptions = { ...defaultOptions, ...options };

   const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
         if (entry.isIntersecting) {
            entry.target.classList.add(inViewClass);
         }
      });
   }, mergedOptions);

   sections.forEach((section) => {
      observer.observe(section);
   });
}
processLine("single-process", "an-line", { threshold: 1 });
processLine("process-btn", "in-view", { threshold: 1 });

// smooth scroll

gsap.registerPlugin(ScrollTrigger);

smoothScroll(document.querySelector('main'));

// this is the helper function that sets it all up. Pass in the content <div> and then the wrapping viewport <div> (can be the elements or selector text). It also sets the default "scroller" to the content so you don't have to do that on all your ScrollTriggers.
function smoothScroll(content, viewport, smoothness) {
   if (!content) return; // Exit if no content is provided
   smoothness = smoothness || 1;

   gsap.set(viewport || content.parentNode, {
      overflow: "hidden",
      position: "fixed",
      height: "100%",
      width: "100%",
      top: 0,
      left: 0,
      right: 0,
      bottom: 0,
   });
   gsap.set(content, { overflow: "visible", width: "100%" });

   let getProp = gsap.getProperty(content),
      setProp = gsap.quickSetter(content, "y", "px"),
      setScroll = ScrollTrigger.getScrollFunc(window),
      removeScroll = () => (content.style.overflow = "visible"),
      killScrub = (trigger) => {
         let scrub = trigger.getTween
            ? trigger.getTween()
            : gsap.getTweensOf(trigger.animation)[0];
         scrub && scrub.pause();
         trigger.animation.progress(trigger.progress);
      },
      height,
      isProxyScrolling;

   function refreshHeight() {
      height = content.clientHeight;
      content.style.overflow = "visible";
      document.body.style.height = height + "px";
      return height - document.documentElement.clientHeight;
   }

   ScrollTrigger.addEventListener("refresh", () => {
      removeScroll();
      requestAnimationFrame(removeScroll);
   });
   ScrollTrigger.defaults({ scroller: content });
   ScrollTrigger.prototype.update = (p) => p;

   ScrollTrigger.scrollerProxy(content, {
      scrollTop(value) {
         if (arguments.length) {
            isProxyScrolling = true;
            setProp(-value);
            setScroll(value);
            return;
         }
         return -getProp("y");
      },
      scrollHeight: () => document.body.scrollHeight,
      getBoundingClientRect() {
         return {
            top: 0,
            left: 0,
            width: window.innerWidth,
            height: window.innerHeight,
         };
      },
   });

   return ScrollTrigger.create({
      animation: gsap.fromTo(
         content,
         { y: 0 },
         {
            y: () => document.documentElement.clientHeight - height,
            ease: "none",
            onUpdate: ScrollTrigger.update,
         }
      ),
      scroller: window,
      invalidateOnRefresh: true,
      start: 0,
      end: refreshHeight,
      refreshPriority: -999,
      scrub: smoothness,
      onUpdate: (self) => {
         if (isProxyScrolling) {
            killScrub(self);
            isProxyScrolling = false;
         }
      },
      onRefresh: killScrub,
   });
}



document.addEventListener("DOMContentLoaded", function () {
   const elements = document.querySelectorAll('.animated-heading')
   elements.forEach(element => {
      gsap.to(element, {
         scrollTrigger: {
            trigger: element,
            start: "top 95%",
            toggleActions: "play reverse play reverse"
         },
         backgroundSize: "100% 100%",
         duration: 0.4,
         delay: 0,
         ease: "ease-out"
      });
   });
   ScrollTrigger.create({
      trigger: ".process-section",
      pin: ".pos-stick",
      start: "top 0%",
      end: "bottom bottom",
      scrub: true,
      // markers: true,
   });

});

document.addEventListener("DOMContentLoaded", function () {
   const elements = document.querySelectorAll('.service-card');

   elements.forEach(element => {
      gsap.fromTo(element,
         { y: 30, opacity: 0 },
         {
            y: 0,
            opacity: 1,
            scrollTrigger: {
               trigger: element,
               start: "top 95%",
               toggleActions: "play reverse play reverse"
            },
            duration: 1,
            ease: "power1.out"
         }
      );
   });
});

