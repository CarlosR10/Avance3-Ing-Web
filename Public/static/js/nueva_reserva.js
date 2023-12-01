const registroFormulario = document.getElementById('registroForm');
registroFormulario.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
    registroReservaSubmit();
});

async function registroReservaSubmit() {
    let registro = {
        restaurantes: document.getElementById('restaurantes').value,
        fecha: document.getElementById('fecha').value,
        hora: document.getElementById('hora').value,
        personas: document.getElementById('personas').value,
        sillas: document.getElementById('sillas').value,
        comentarios: document.getElementById('comentarios').value,
    };
    
    // Prepare the POST request
    let urlLocal = 'http://localhost/preorder/create';
    let url = 'https://addled-radiuses.000webhostapp.com/preorder/create'
    let options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(registro),
    };

    let response = await fetch(urlLocal, options);
    let responseData = await response.json();

    if (responseData.success){
        console.log('redireccionado a reservas...');

        // Mensaje enviado por el servidor
        console.log('Mensaje del servidor:', responseData.message);

        // redireccionar a login
        window.location.href='http://localhost/preorder/search';
        //window.location.href='https://addled-radiuses.000webhostapp.com/preorder/search'       
    }
    else {
        responseData.message = "<p><strong> Ups! </strong> No ha sido posible registrar su reserva.</p>";
        //alert(responseData.message);

        // Obtener el div existente
        let myDiv = document.getElementById("info");

        // Añadir el párrafo al div
        myDiv.innerHTML = responseData.debug;
        myDiv.style.display = "block"; // como por defecto esta en display "none" cambiarlo  a "block"

        // Mostrar el div
        myDiv.style.opacity = 1;

        // Ocultar el div 
        setTimeout(function() {
            myDiv.style.opacity = 0;

            // Ocultar el div después de que se complete el desvanecimiento (1 segundo)
            setTimeout(function() {
                myDiv.style.display = 'none';
            }, 1000);
        }, 3000);

    }
    
}
