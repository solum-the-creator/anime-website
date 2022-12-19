
$("#file").on('change', function(){
  let fileList = this.files[0];
  
  $.ajax({
    dataType:'json',
    url:`../controller/updateBackImg.php?newImage=${fileList.name}`,
    success:function(jsondata){
      console.log(jsondata);
      $(".headerImg").css('backgroundImage', `url(../image/accountHeader/${fileList.name})`);
    }
  });
});

$("#fileUser").on('change',function(){
  let fileList = this.files[0];

  $.ajax({
    dataType:'json',
    url:`../controller/updateUserImg.php?newImage=${fileList.name}`,
    success:function(jsondata){
      console.log(jsondata);
      $("#userImageMain").attr("src",`../image/userImage/${fileList.name}`);
      
    }
  });
});

