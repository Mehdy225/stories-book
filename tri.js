$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tri #te .row .col-md-8 .card-body").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      console.log(this);
    });
  
  });
});


