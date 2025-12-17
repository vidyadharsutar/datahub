// custom upload file option
var $dragArea = $(".input-file");

$(function(){
  $dragArea.on("dragenter", function(){
    $(this).addClass("event-dragenter");
  });
  $dragArea.on("dragleave", function(){
      $(this).removeClass("event-dragenter");
  });
  $dragArea.find("input[type='file']").on("change", function(e){
    $dragArea.removeClass("event-dragenter");
    
    var $fileName = e.target.files[0].name;
    console.log($fileName);
    $dragArea.addClass("event-drop");
    $dragArea.attr("data-filename", $fileName);
  });
});
// custom upload file option - end