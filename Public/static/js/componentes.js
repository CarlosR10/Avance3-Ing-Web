/*$(document).ready(function() { 
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
    $("#modal").hide()    
  });
});

ya lo hace php*/

// ---------------------info message------------------------
let info_msg = document.getElementById('info_msg');
if (info_msg !== null){
    document.addEventListener('DOMContentLoaded', function() {
      let info_msg = document.getElementById('info_msg');
    
      // Mostrar el div
      info_msg.style.opacity = 1;
    
      // Ocultar el div después de 3 segundos
      setTimeout(function() {
          info_msg.style.opacity = 0;
    
          // Ocultar el div después de que se complete el desvanecimiento (1 segundo)
          setTimeout(function() {
              info_msg.style.display = 'none';
          }, 1000);
    
      }, 3000);
    });
}

// ---------------------logout------------------------
// Obtener el botón cerrar sesion por su ID
let logoutBtn = document.getElementById("logout-btn");

// Añadir un evento de clic al botón de cerrar sesion
logoutBtn.addEventListener("click", function() {
    // Este código se ejecutará cuando se haga clic en el botón
    alert("¡Un gusto que haya visitado nuestro portal! Vuelve pronto, te esperamos.");
});

// para redireccionar a login cuando se cierra sesion
function logout() {
    window.location.href = 'http://localhost/user/login';
    //window.location.href = 'https://addled-radiuses.000webhostapp.com/user/login';
}

// ---------------------going back home------------------------

// Función para obtener el valor de una cookie específica (para poder seguir desplegando el nombre de usuario en
// caso de que echemos para atras en mis reservas o restaurantes)
function getCookie(nombre) {
  // obtenemos las cookies y las separamos
  let cookies = document.cookie.split('; ');

  // iteramos por las cookies
  for (let i = 0; i < cookies.length; i++) {

      // separamos el nombre de la cookie del valor
      let cookie = cookies[i].split('=');

      // si el nombre de la cookie es igual al nombre buscado
      if (cookie[0] === nombre) {
          // retornar el valor de la cooki
          return cookie[1];
      }
  }
  // sino retorna null
  return null;
}

// funcion para redireccionar a home
function goHome(){
    // Mandar el parametro id
    let urlParameter = 'http://localhost/user/home/?id=';
    let urlParameterDeploy = 'https://addled-radiuses.000webhostapp.com/user/home/?id=';

    // Obtener el valor de la cookie user id
    let idCookie = getCookie("user_id");
    let urlBackHome = '';

    if (idCookie !== null){
      // Url junto con el parametro
      urlBackHome = urlParameter + idCookie;
    }
    else {
      // Url sin el parametro
      urlBackHome = urlParameter;
    }

    window.location.href = urlBackHome;
}
