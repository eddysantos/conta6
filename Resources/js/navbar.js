$("#toggle").click(function(event){
  event.preventDefault();
  if ($(this).hasClass("isDown")) {
    $(".navbar-fixed-top").animate({"margin-top" : "-64px"},"fast");
    $("#content").animate({"margin-top" : "5px"},"fast");
    $(this).removeClass("isDown");
  }else {
    $(".navbar-fixed-top").animate({"margin-top" : "10px"},"fast");
    $("#content").animate({"margin-top" : "80px"},"fast");
    $(this).addClass("isDown");
  }
  return false;
});
