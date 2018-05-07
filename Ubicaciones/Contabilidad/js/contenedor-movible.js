var lastIndex = 0;
$("li").on("click", function(){
  var difference = Math.abs($(this).index() - lastIndex);
  $(".contenedor-movible").css({
    "transition": "transform " + difference * 300 + "ms ease-in-out",
    "transform": "translateX(" + $(this).index() * -100 + "%)"
  });
  lastIndex = $(this).index();
})
