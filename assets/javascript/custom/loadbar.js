$(function() {
  $('#loadBar span').animate({ width: '100%' }, 1500, 'swing');
});

// Sequential nav color fade in
$('.desktop-menu li').each(function(index, element) {
    $(element).delay(index*300).queue(function(){
      $(this).addClass('colorize');
    });
});

// Logo fade in
setTimeout(function(){
  $('.home-link').addClass('colorize');
}, 300);

setTimeout(function(){
  $('#featured-hero').addClass('animate-in');
}, 500);

setTimeout(function(){
  $('.main-content').addClass('animate-in').css({"transform":"translate(0,0)"});
  skrollr.init();

  if (skrollr.init().isMobile()) {
      skrollr.init().destroy();
  }
  $('.parallax-bg').addClass('animate-in').css({"opacity": "1"});
}, 700);

setTimeout(function(){
  $('.main-content').removeClass('animate-in');
  $('.parallax-bg').removeClass('animate-in');
}, 1800);
