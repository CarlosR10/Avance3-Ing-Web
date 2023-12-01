function onclickSubmit(){
    eliminarReservaSubmit();
}

async function eliminarReservaSubmit() {
    let registro = {
        preorder_id: document.getElementById('preorder_id').value,
        restaurantes: document.getElementById('restaurantes').value,
    };
    
    // Prepare the POST request
    let urlLocal = 'http://localhost/preorder/delete';
    let url = 'https://addled-radiuses.000webhostapp.com/preorder/delete'
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
        responseData.message = "<p><strong> Ups! </strong> No ha sido posible eliminar su reserva.</p>";
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