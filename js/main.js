$(".ratingRadio").change(function(){
	let valueRating = this.value;
	$.ajax({
		dataType:'json',
		url:'../controller/checkLogin.php',
		success: function(jsondata){
			if(jsondata.isLogin==true){
				let locSet = document.getElementsByClassName("anime-title")[0];
				$.ajax({
					dataType:'json',
					url:`../controller/ratingAnime.php?valueRating=${valueRating}&userId=${jsondata.userId}&animeId=${locSet.dataset.anime}`,
					success: function(jsondataRating){
						console.log(jsondataRating);
					}
				});
			}
			if(jsondata.isLogin==false){
				$(".ratingRadio").prop('checked',false);
				window.location.href = '#popup1';
				
			}
		}
	});
});

$.ajax({
	dataType:'json',
	url:'../controller/checkLogin.php',
	success: function(jsondata){
	if(jsondata.isLogin==true){
		let locSet = document.getElementsByClassName("anime-title")[0];
		$.ajax({
			dataType:'json',
			url:`../controller/ratingCheck.php?userId=${jsondata.userId}&animeId=${locSet.dataset.anime}`,
			success: function(jsondataRating){
				console.log(jsondataRating);
				if(jsondataRating.rated){
					$(`.ratingRadio:eq(-${jsondataRating.valueRating})`).prop('checked',true);
				}
				else{
					$(".ratingRadio").prop('checked',false);
				}
			}

		});

		$.ajax({
			dataType:'json',
			url:`../controller/userListCheck.php?animeId=${locSet.dataset.anime}`,
			success: function(jsondataMyList){
				console.log(jsondataMyList);
				if(jsondataMyList.inList){
					$(".selectFilter").val(jsondataMyList.category);
				}
				else{
					$(".selectFilter").val(0);
				}
			}
		});

	}
	} 
});
/*"<div class=\"row review\">
                            <div class=\"col-md-2 box-review1\">
                                <img src=\"../image/default-user.png\" alt=\"user\" class=\"user-profile\">
                            </div>
                            <div class=\"col-md-10 box-review2\">
                                <h5>$row[5]</h5>
                                <h5 class=\"dateAddedReview\">$row[4]</h5>
                                <div class=\"content textReview\">
                                    <p style=\"color:silver;\">$row[3]</p>
                                </div>
                            </div>
                        </div>"*/

$('#reviewForm').submit(function(e){
	var $form = $(this);

	console.log($form.serializeArray()[0].value);
	var reviewTextValue = $form.serializeArray()[0].value; 
	$.ajax({
		dataType:'json',
		url:'../controller/checkLogin.php',
		success: function(jsondata){
			if(jsondata.isLogin==true){
				let locSet = document.getElementsByClassName("anime-title")[0];
				$.ajax({
		type: $form.attr('method'),
		url: $form.attr('action'),
		data: {reviewText: reviewTextValue, idUser: jsondata.userId, animeId: locSet.dataset.anime},
		dataType:'json',
		success: function(jsondataReview){
			console.log(jsondataReview);
			let output=`<div class=\"row review\">
                            <div class=\"col-md-2 box-review1\">
                                <img src=\"../image/${jsondataReview.userImage}\" alt=\"user\" class=\"user-profile\">
                            </div>
                            <div class=\"col-md-10 box-review2\">
                                <h5>${jsondataReview.userName}</h5>
                                <h5 class=\"dateAddedReview\">${jsondataReview.dateEdded}</h5>
                                <div class=\"content textReview\">
                                    <p style=\"color:#E8E8E8;\">${jsondataReview.text}</p>
                                </div>
                            </div>
                        </div>`;
                        let reviewsElems = $("#reviews").html();
                        $("#reviews").html(reviewsElems+output);
                        $("#comment").val("");
            

		}
	}).done(function() {
		console.log('success');
	}).fail(function(){
		console.log('fail');
	});
			}
			if(jsondata.isLogin==false){
				window.location.href = '#popup1';
				return false;
			}
		}
	});
	
	e.preventDefault(); 
});

$('[href^="#comment"]').on('click', function(){
  let href = $(this).attr('href'), elem = $(document).find(href);
  if(elem.length > 0) {
    let posY = elem.eq(0).offset().top;
    $('html, body').animate({
      scrollTop: posY
    }, 1000);
  }
  return false;
});
				

$(".selectFilter").on('change',function(){
	let selectItem = $(this).val();
	
	$.ajax({
		dataType:'json',
		url:'../controller/checkLogin.php',
		success: function(jsondata){
			if(jsondata.isLogin==true){
				let locSet = document.getElementsByClassName("anime-title")[0];
				$.ajax({
					dataType:'json',
					url:`../controller/setMyList.php?selectListItem=${selectItem}&animeId=${locSet.dataset.anime}`,
					success:function(jsondataMyList){
						console.log(jsondataMyList);
					}
				});
			}

			if(jsondata.isLogin==false){
				window.location.href = '#popup1';
				$(".selectFilter").val(0);
			}
		}
	});

});





