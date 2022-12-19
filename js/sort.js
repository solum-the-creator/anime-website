$(".sortBySelect").change(function(){
	
	$.ajax({
		dataType: 'json',
		url: `../controller/sortBy.php?action=${this.value}`,
		success: function(jsondata){
			let output = '';
			console.log(jsondata);
			$.each(jsondata, (index,anime)=>{

				let poster = `../image/${anime.animeImage}`;
				output += `<div class="animeCard">
    		 		<div class="row">
    		 			<div class=" col-md-3 cardImage">		
    					<img src="${poster}" alt="poster">
    		 		</div>
    		 		<div class="col-md-8 cardInfo" >
    		 			<h1><a href="../page/anime.php?animeId='${anime.idAnime}'" class=\"animeName\" data-anime=\"${anime.idAnime}\">${anime.Name}</a></h1>
    		 			<h5>${anime.releaseDate}</h5>
    		 			<h5>${anime.animeGenre}</h5>
    		 			<div class=\"module\">
    		 				<p>${anime.description}</p>
    		 			</div>
    		 			
    		 		</div>
    		 		</div>
    		 		
    		 	</div>`;
			});
			$("#animeSortedList").html(output);
		}
	});
});


function getAnimeIdList(){

    let count = $(".animeCard".length);
    $(".animeName").each(function(index){
        console.log(this.dataset.anime);
    });
}

function setAnimeCard(animeImage,idAnime,name,releaseDate,genre,description){

    let poster = `../image/${animeImage}`;
    let output = `<div class="animeCard">
                    <div class="row">
                        <div class=" col-md-3 cardImage">       
                        <img src="${poster}" alt="poster">
                    </div>
                    <div class="col-md-8 cardInfo" >
                        <h1><a href="../page/anime.php?animeId='${idAnime}'" class=\"animeName\" data-anime=\"${idAnime}\">${name}</a></h1>
                        <h5>${releaseDate}</h5>
                        <h5>${genre}</h5>
                        <div class=\"module\">
                            <p>${description}</p>
                        </div>
                        
                    </div>
                    </div>
                    
                </div>`;
    return output;
}


$('.selectFilter').on('change', function(){
    let genre = $('.selectGenre').val();
    let type = $('.selectType').val();
    let mpaa = $('.selectMPAA').val();

    if(genre!=0){
         if(type!=0 && mpaa!=0){
            $.ajax({
                dataType:'json',
                url:`../controller/filterAnime.php?filterId=0&genre=${genre}&type=${type}&mpaa=${mpaa}`,
                success(jsondata){

                    
                    let output ='';
                    $.each(jsondata, (index,anime)=>{
                        output += setAnimeCard(anime.animeImage,anime.idAnime,anime.Name,anime.releaseDate,anime.animeGenre,anime.description);
                    });
                    $("#animeSortedList").html(output);
                }


            });



         

     }
     else if(type !=0 && mpaa ==0){
        $.ajax({
                dataType:'json',
                url:`../controller/filterAnime.php?filterId=1&genre=${genre}&type=${type}`,
                success(jsondata){
                    
                    let output ='';
                    $.each(jsondata, (index,anime)=>{
                        output += setAnimeCard(anime.animeImage,anime.idAnime,anime.Name,anime.releaseDate,anime.animeGenre,anime.description);
                    });
                    $("#animeSortedList").html(output);
                }

            });

         
     }
     else if(type ==0 && mpaa !=0){
            $.ajax({
                dataType:'json',
                url:`../controller/filterAnime.php?filterId=2&genre=${genre}&mpaa=${mpaa}`,
                success(jsondata){
                    
                    let output ='';
                    $.each(jsondata, (index,anime)=>{
                        output += setAnimeCard(anime.animeImage,anime.idAnime,anime.Name,anime.releaseDate,anime.animeGenre,anime.description);
                    });
                    $("#animeSortedList").html(output);
                }

            });

            
        }
     else if(type ==0 && mpaa ==0){
            $.ajax({
                dataType:'json',
                url:`../controller/filterAnime.php?filterId=3&genre=${genre}`,
                success(jsondata){
                    
                    let output ='';
                    $.each(jsondata, (index,anime)=>{
                        output += setAnimeCard(anime.animeImage,anime.idAnime,anime.Name,anime.releaseDate,anime.animeGenre,anime.description);
                    });
                    $("#animeSortedList").html(output);
                }

            });

            
        }
    }
    else{
        if(type !=0 && mpaa !=0){
            $.ajax({
                dataType:'json',
                url:`../controller/filterAnime.php?filterId=4&type=${type}&mpaa=${mpaa}`,
                success(jsondata){
                    
                    let output ='';
                    $.each(jsondata, (index,anime)=>{
                        output += setAnimeCard(anime.animeImage,anime.idAnime,anime.Name,anime.releaseDate,anime.animeGenre,anime.description);
                    });
                    $("#animeSortedList").html(output);
                }

            });

         
     }
     else if(type !=0 && mpaa ==0){
            $.ajax({
                dataType:'json',
                url:`../controller/filterAnime.php?filterId=5&type=${type}`,
                success(jsondata){
                    
                    let output ='';
                    $.each(jsondata, (index,anime)=>{
                        output += setAnimeCard(anime.animeImage,anime.idAnime,anime.Name,anime.releaseDate,anime.animeGenre,anime.description);
                    });
                    $("#animeSortedList").html(output);
                }

            });

         
     }
     else if(type ==0 && mpaa !=0){
            $.ajax({
                dataType:'json',
                url:`../controller/filterAnime.php?filterId=6&mpaa=${mpaa}`,
                success(jsondata){
                    
                    let output ='';
                    $.each(jsondata, (index,anime)=>{
                        output += setAnimeCard(anime.animeImage,anime.idAnime,anime.Name,anime.releaseDate,anime.animeGenre,anime.description);
                    });
                    $("#animeSortedList").html(output);
                }

            });

            
        }
     else if(type ==0 && mpaa ==0){
            $.ajax({
                url:`../controller/getAllAnime.php`,
                success: function(data){
                    $('#animeSortedList').html(data);
                }
            });
        }
    }
    
});