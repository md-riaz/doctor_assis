$(function () {
  setTimeout(function () {
    $("#removeAlert").slideUp(500, function () {
      $(this).remove();
    });
  }, 5000);
});