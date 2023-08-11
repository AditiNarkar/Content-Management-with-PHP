$(document).ready(function() {
  $('#summernote').summernote({
    height:200
  });
});

$(document).ready(function(){
  $('#select').click(function(event){
    if(this.checked){
      $('.checkBoxes').each(function(){
        this.checked = true;
      });
      }
    else{
      $('.checkBoxes').each(function(){
        this.checked = false;
      });
    }
  });
  var div_box = "<div id ='load-screen'><div id='loading'></div></div>";

  $("body").prepend(div_box);

  $('#load-screen').delay(200).fadeOut(200, function(){
    $(this).remove();
  });

});

//AJAX

function loadOnlineUsers()
{
  $.get("functions.php?onlineusers=result", function(data){
    $(".onlineUsers").text(data); //span class
  });
}

setInterval(function(){
  loadOnlineUsers();

},500);

