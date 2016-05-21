//Activate Skrollr
window.onload = function() {
  var s = skrollr.init();
  if (s.isMobile()) {
      s.destroy();
  }
};
