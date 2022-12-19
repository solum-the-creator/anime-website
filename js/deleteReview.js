
$(".deleteButton").on("click",function(){
	
	let idReview = $(this).data("idreviewdelete");
	let trReviewItem = $(this).closest("tr");
	$.ajax({
		dataType:'json',
		url:`../controller/deleteReviewUser.php?idReview=${idReview}`,
		success:function(jsondata){
			console.log(jsondata);
			trReviewItem.remove();
		}
	});
});