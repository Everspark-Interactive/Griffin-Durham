// Mobile accordion menu code
!function(s){s(document).ready(function(){var e;s("#cssmenu li.has-sub>a").on("click",function(){var e=s(this).parent("li");e.hasClass("open")?(e.removeClass("open"),e.find("li").removeClass("open"),e.find("ul").slideUp()):(e.addClass("open"),e.children("ul").slideDown(),e.siblings("li").children("ul").slideUp(),e.siblings("li").removeClass("open"),e.siblings("li").find("li").removeClass("open"),e.siblings("li").find("ul").slideUp())}),function(s,e,i){s/=255,e/=255,i/=255;var l=Math.max(s,e,i),n=Math.min(s,e,i),a=(l+n)/2;if(l==n);else{l}return a}((e=(e=s("#cssmenu").css("color")).slice(4)).slice(0,e.indexOf(",")),(e=e.slice(e.indexOf(" ")+1)).slice(0,e.indexOf(",")),(e=e.slice(e.indexOf(" ")+1)).slice(0,e.indexOf(")")))>.7?(s("#cssmenu>ul>li>a").css("text-shadow","0 1px 1px rgba(0, 0, 0, .35)"),s("#cssmenu>ul>li>a>span").css("border-color","rgba(0, 0, 0, .35)")):(s("#cssmenu>ul>li>a").css("text-shadow","0 1px 0 rgba(255, 255, 255, .35)"),s("#cssmenu>ul>li>a>span").css("border-color","rgba(255, 255, 255, .35)"))})}(jQuery);

// Listen to tab events to enable outlines (accessibility improvement)
document.body.addEventListener('keyup', function(e) {
  if (e.which === 9) /* tab */ {
    document.documentElement.classList.remove('no-focus-outline');
  }
});

// Mobile full screen menu
function openNav() {
	document.getElementById("popup-nav").classList.remove("invisible");
	document.getElementById("popup-nav").style.height = "100%";
	document.getElementById("popup-nav").tabIndex = 0;
  document.body.classList.add("locked");
}

function closeNav() {
	document.getElementById("popup-nav").classList.add("invisible");
	document.getElementById("popup-nav").style.height = "0%";
	document.getElementById("popup-nav").tabIndex = -1;
  document.body.classList.remove("locked");
}

// Sticky header
window.onscroll = function changeClass(){
  var scrollPosY = window.pageYOffset | document.body.scrollTop;

	if(scrollPosY > 150) {
        headerStuck.classList.add('fixed-transition');
    } else if(scrollPosY <= 250) {
        headerStuck.classList.remove('fixed-transition');
    }
}

// Equalize boostrap carousel with class of carousel-equalize
// https://snook.ca/archives/javascript/normalize-bootstrap-carousel-heights
function normalizeSlideHeights() {
    $('.carousel-equalize').each(function(){
      var items = $('.carousel-item', this);
      // reset the height
      items.css('min-height', 0);
      // set the height
      var maxHeight = Math.max.apply(null,
          items.map(function(){
              return $(this).outerHeight()}).get() );
      items.css('height', maxHeight + 'px');
    })
}
$(window).on(
    'load resize orientationchange',
    normalizeSlideHeights);

// Popup video modal code
$(document).ready(function() {
  // Gets the video src from the data-src on each button
  var $videoSrc;
  $('.video-modal-open').click(function() {
    $videoSrc = $(this).data("src");
    $videoPerma = $(this).data("perma");
  });
  //console.log($videoSrc);

  // when the modal is opened autoplay it
  $('#videoModal').on('shown.bs.modal', function(e) {

    // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
    $("#video").attr('src', $videoSrc);
    $("#video-transcript").attr('href', $videoPerma);
  })

  // stop playing the youtube video when I close the modal
  $('#videoModal').on('hide.bs.modal', function(e) {
    // a poor man's stop video
    $("#video").attr('src', '');
    $("#video-transcript").attr('href', '');
  })
  // document ready
});

// Optional cookie banner code
if (localStorage.getItem("cookieSeen") != "shown") {
  $(".cookie-banner").delay(1500).fadeIn();
};$(".cookie-banner__close").click(function() {
  $(".cookie-banner").fadeOut();
  localStorage.setItem("cookieSeen","shown")
})

// Load AOS
AOS.init({
    once: true,
    easing: "ease-in-out-cubic",
    duration: "800",
    delay: 50, // values from 0 to 3000, with step 50ms
  });