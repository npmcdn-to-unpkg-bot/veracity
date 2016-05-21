$(function() {
  $('#loadBar span').animate({ width: '100%' }, 1500, 'swing');
});

// Sequential nav color fade in
$('#menu-primary li').each(function(index, element) {
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
}, 700);

setTimeout(function(){
  $('.main-content').removeClass('animate-in');
}, 1800);
