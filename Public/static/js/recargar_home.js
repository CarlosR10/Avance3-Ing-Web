// Variable para rastrear si el bloqueo está activado
let bloqueoActivado = false;

// Función para establecer una cookie
function setCookie(name, value, days) {
  const expires = new Date();
  expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
}

// Función para obtener el valor de una cookie
function getCookie(name) {
  const keyValue = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
  return keyValue ? keyValue[2] : null;
}

// Función para desactivar el cuerpo de la página por unos segundos
function disableBody() {
  // Deshabilitar interacción con el cuerpo
  document.body.style.pointerEvents = 'none';

  // Obtener la URL actual
  const currentUrl = window.location.href;

  // Verificar si la URL es 'user/home' o 'user/login'
  if (currentUrl.includes('user/home') || currentUrl.includes('user/login')) {
    // Volver a habilitar la interacción después de 2 segundos
    setTimeout(function () {
      document.body.style.pointerEvents = 'auto';
      bloqueoActivado = false; // Desactivar el bloqueo

      // Redireccionar solo si la URL es 'user/home'
      if (currentUrl.includes('user/home')) {
        const redireccionarContador = parseInt(getCookie('redireccionarContador')) || 0;
        if (redireccionarContador === 0) {
          location.reload(true);
          // Incrementar el contador y actualizar la cookie
          setCookie('redireccionarContador', '1', 365);
        }
      }

      // Restablecer el contador a 0 si la URL es 'user/login'
      if (currentUrl.includes('user/login')) {
        setCookie('redireccionarContador', '0', 365);
      }
    }, 2000);
  }
}

// Llamar a disableBody después de 0.2 segundos
setTimeout(function() {
  disableBody();
  bloqueoActivado = true;
}, 200);