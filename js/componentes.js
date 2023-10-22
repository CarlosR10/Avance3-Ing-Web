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

const menu = document.querySelector('#collapse');

menu.addEventListener('click', () => {
  if (menu.classList.contains('show')) {
    menu.classList.remove('show');
  }
});