//JavaScript for label effects only
	$(document).ready(function(){
		$(".col-1 input").val();
		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("tiene-contenido");
			}else{
				$(this).removeClass("tiene-contenido");
			}
		});
    $(".col-2 input").val("");
		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("tiene-contenido");
			}else{
				$(this).removeClass("tiene-contenido");
			}
		});
		$(".col-3 input").val("");
		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("tiene-contenido");
			}else{
				$(this).removeClass("tiene-contenido");
			}
		});
		$(".col-4 input").val("");
		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("tiene-contenido");
			}else{
				$(this).removeClass("tiene-contenido");
			}
		});


		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	});
