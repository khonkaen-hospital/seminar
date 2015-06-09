
$.pjax.defaults.timeout = 1000000;

$(document).on('pjax:timeout', function(event) {
  // Prevent default timeout redirection behavior
  console.log(event);
  event.preventDefault();
})