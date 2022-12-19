$("#searchMainForm").submit(function(e){
	var $form = $(this);
	let searchText = $("#inputSearch").val();
	if(searchText!=""){
		$.ajax({
			dataType:'json',
			type:$form.attr('method'),
			url: $form.attr('action'),
			data:{text:searchText},
			success: function(jsondata){
				console.log(jsondata);
				let output = '';
				let output2 = `Поиск 	&#171;${searchText}&#187;`;
				 $.each(jsondata, (index,anime)=>{
				 	output+=`<div class="animes-grid-item col-md-3 p-4 mb-3">
    						<div class="imgAnimeBox mb-2">
    							<a href="anime.php?animeId='${anime.idAnime}'">
    								<img src="../image/${anime.animeImage}" alt="poster">
    							</a>
    						</div>
    						<div class="nameResultAnime">
    							<a href="anime.php?animeId='${anime.idAnime}'"><h3>${anime.Name}</h3></a>
    						</div>
    						<div class="smallInfoAnime">
    							<h5>${anime.animeType} / ${anime.releaseDate}</h5>
    						</div>
    					</div>`;
				 });
				 $('#resultSearchAnimeBox').html(output);
				 $('#searchTitleResult').html(output2);

			}
		});
	}
	else{
		alert('Заполните поле поиска');
	}

	console.log($("#inputSearch").val());
	e.preventDefault(); 
});

$(document).ready(function(){
        var $form = $("#searchMainForm");
	let searchText = $("#inputSearch").val();
	if(searchText!=""){
		$.ajax({
			dataType:'json',
			type:$form.attr('method'),
			url: $form.attr('action'),
			data:{text:searchText},
			success: function(jsondata){
				console.log(jsondata);
				let output = '';
				let output2 = `Поиск 	&#171;${searchText}&#187;`;
				let count = 1;
				 $.each(jsondata, (index,anime)=>{
				 	count++;
				 	output+=`<div class="animes-grid-item col-md-3 p-4 mb-3">
    						<div class="imgAnimeBox mb-2">
    							<a href="anime.php?animeId='${anime.idAnime}'">
    								<img src="../image/${anime.animeImage}" alt="poster">
    							</a>
    						</div>
    						<div class="nameResultAnime">
    							<a href="anime.php?animeId='${anime.idAnime}'"><h3>${anime.Name}</h3></a>
    						</div>
    						<div class="smallInfoAnime">
    							<h5>${anime.animeType} / ${anime.releaseDate}</h5>
    						</div>
    					</div>`;
				 });
				 $('#resultSearchAnimeBox').html(output);
				 $('#searchTitleResult').html(output2);
				 

			}
		});
	}
	else{
		alert('Заполните поле поиска');
	}

	console.log($("#inputSearch").val());
	
    });