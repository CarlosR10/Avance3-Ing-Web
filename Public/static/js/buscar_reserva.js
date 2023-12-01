const reservaFormulario = document.getElementById('busquedaForm');
reservaFormulario.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
    formularioSubmit();
});

async function formularioSubmit() {
    let registro = {
        busqueda: document.getElementById('busqueda').value,
    };

    // Prepare the POST request
    let urlLocal = 'http://localhost/preorder/read';
    let url = 'https://addled-radiuses.000webhostapp.com/preorder/read';
    let options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(registro),
    };

    let response = await fetch(urlLocal, options);
    let responseData = await response.json();

    // Si encuentra algo en la busqueda
    if (responseData.success){

        // Si devuelve un array con datos de reserva en base a la busqueda
        if (responseData.result != null) {

            console.log('buscando tu reserva...');

            // Mensaje enviado por el servidor
            console.log('Mensaje del servidor:', responseData.message);

            // Obtenemos el scrollpane mediante el id
            const preorderListName = document.getElementById('preorder-list');
            let htmlContent = '';

            // agregamos cada elemento que coincida con la busqueda a la cadena htmlcontent
            responseData.result.forEach(item => {
                htmlContent += `<div class="active rounded-4">
                    <p class="ms-3 mt-2" style="font-size: 1.45em;">${item.nombre}</p>
                    <div class="container d-flex justify-content-end">
                        <a type="button" href="<?php echo LOCAL_HOST; ?>/preorder/edit/?id=${item.cod_reserva}" class="d-flex justify-content-center align-items-center mx-md-3 mx-2  btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px"><i class="bi bi-pencil-square"></i></a>
                        <a type="button" href="<?php echo LOCAL_HOST; ?>/preorder/cancel/?id=${item.cod_reserva}" class="d-flex justify-content-center align-items-center btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px"><i class="bi bi-trash-fill" style="color: red;"></i></a>
                    </div>
                </div>`;
            });

            // introducimos dentro del scrollpane la cadena con todos los elementos
            preorderListName.innerHTML = htmlContent;

        } 
    // Si no encuentra ninguna coincidencia de busqueda
    else {
            responseData.message = "<p><strong> Ups! </strong> Ese restaurante no trabaja con nosotros o no tienes ninguna reserva registrada con ese restaurante.</p>";

            // Obtener el div existente
            let myDiv = document.getElementById("info");

            // Añadir el párrafo al div
            myDiv.innerHTML = responseData.message;
            myDiv.style.display = "block"; // como por defecto esta en display "none" cambiarlo  a "block"

            // Mostrar el div
            myDiv.style.opacity = 1;

            // Ocultar el div 
            setTimeout(function() {
                myDiv.style.opacity = 0;

                // Ocultar el div después de que se complete el desvanecimiento (1 segundo)
                setTimeout(function() {
                    myDiv.style.display = 'none';
                }, 100);
            }, 3500);
        }
  
    }
}






    