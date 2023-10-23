$(document).ready(function() { 
    $("#header").load("componentes/header.html", {
    method: "GET"
    });
});

$(document).ready(function() { 
    $("#footer").load("componentes/footer.html", {
    method: "GET"
    });
});

$(document).ready(function() {
  $("#close").click(function() {
    $("#DeleteModal").hide()    
  });
});

$(document).ready(function() {
  $("#close2").click(function() {
    $("#FilterModal").hide()    
  });
});