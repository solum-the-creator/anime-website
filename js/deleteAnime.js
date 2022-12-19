
$(".deleteButton").on("click",function(){
	
	let idAnime = $(this).data("idanimedelete");
	let trAnimeItem = $(this).closest("tr");
	
	$.ajax({
		dataType:'json',
		url:`../controller/deleteAnime.php?idAnime=${idAnime}`,
		success:function(jsondata){
			console.log(jsondata);
			trAnimeItem.remove();
		}
	});
});
