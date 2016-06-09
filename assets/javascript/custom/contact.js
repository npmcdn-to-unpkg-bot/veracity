// CONTACT
// Hide form
$('#contactForm').hide();

// Change loadbar size on contact hover
$('a[href=#contact]').hover(
  function() {
    $( "#loadBar" ).addClass( "hover" );
  }, function() {
    $( "#loadBar" ).removeClass( "hover" );
  }
);

// SlideToggle Contact Form
$('a[href=#contact]').click(function() {
  if($(this).hasClass("clicked")) {
    $(this).removeClass("clicked");
    $('.container').removeClass('no-pad');
    $('#contactForm').slideUp( "slow", function() {
      $('#navBar').removeClass('stick-down');
    });
    $('.overlay').removeClass('visible');
    $('#closeForm').removeClass('visible');
    $('body').removeClass("contact");

    if (!$('body').hasClass('mobile-nav')) {
      $('body').removeClass("fixed");
    }
  } else {
    $(this).addClass("clicked");
    $('#navBar').addClass('stick-down');
    $('.container').addClass('no-pad');
    $('#contactForm').slideDown( "slow", function() {});
    $('.overlay').addClass('visible');
    $('#closeForm').addClass('visible');
    $('body').addClass("contact");

    if (!$('body').hasClass('mobile-nav')) {
      $('body').addClass("fixed");
    }
  }
});

// Close Form Button
$('#closeForm').click(function(){
  $('#contactForm').slideUp( "slow", function() {
    $('#navBar').removeClass('stick-down');
  });
  $('.overlay').removeClass('visible');
  $('#closeForm').removeClass('visible');
  $('body').removeClass("contact");

  if (!$('body').hasClass('mobile-nav')) {
    $('body').removeClass("fixed");
  }
});

var distance = $('#navBar').offset().top,
$window = $(window);

$window.scroll(function() {
  if ( $window.scrollTop() >= distance ) {
      $('#navBar').removeClass('stick-down');
  }
});

$(window).on('changed.zf.mediaquery', function(event, newSize, oldSize){
  if(newSize ==  "medium") {
    if (oldSize == "small") {
      $('#contactForm').slideUp();
      $('body').removeClass("fixed");
      $('#closeForm').removeClass('visible');
      $('.overlay').removeClass('visible');
    }
  }
  if(newSize ==  "small") {
    if (oldSize == "medium") {
      $('#contactForm').slideUp();
      $('body').removeClass("fixed");
      $('#closeForm').removeClass('visible');
      $('.overlay').removeClass('visible');
    }
  }

});

////////////////////////////////////////
// Validation
////////////////////////////////////////

// Name can't be blank
$('#contactName').on('input', function() {
	var input=$(this);
	var is_name=input.val();
	if(is_name){
    input.removeClass("invalid").addClass("valid");
    input.siblings('label').addClass("float");
  }
	else{
    input.removeClass("valid").addClass("invalid");
    input.siblings('label').removeClass("float");
  }
});

// Message can't be blank
$('#contactMessage').keyup(function(event) {
	var input=$(this);
	var message=$(this).val();
	console.log(message);
	if(message){
    input.removeClass("invalid").addClass("valid");
    input.siblings('label').addClass("float");
  }
	else{
    input.removeClass("valid").addClass("invalid");
    input.siblings('label').removeClass("float");
  }
});

$(document).ready(function() {
    var $fields = $(".inputs :input");
    $fields.keyup(function() {
        var $emptyFields = $fields.filter(function() {
            // remove the $.trim if whitespace is counted as filled
            return $.trim(this.value) === "";
        });

        if (!$emptyFields.length) {
            $("#formSubmit").removeClass("disabled");
        }
    });
});

// Email must be an email
$('#contactEmail').on('input', function() {
	var input=$(this);
  var email=input.val();
  if(email){
    input.siblings('label').addClass("float");
  }
	else{
    input.siblings('label').removeClass("float");
  }
	var re = /[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	var is_email=re.test(input.val());
	if(is_email){
    input.removeClass("invalid").addClass("valid");
  }
	else{
    input.removeClass("valid").addClass("invalid");
  }
});
