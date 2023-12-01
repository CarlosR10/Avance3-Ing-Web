const filtroFormulario = document.getElementById('filterForm');
filtroFormulario.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
    filtroSubmit();
    closeModal();
});

function closeModal(){
    // Obtener el botón salir por su id
    let closeButton = document.getElementById('closeBtn');

    // Simular un clic en el botón
    closeButton.click();
}

async function filtroSubmit() {
    let registro = {
        comida: document.querySelector('input[name="comida"]:checked').value,
        tiporest: document.querySelector('input[name="tiporest"]:checked').value,
        precio: document.querySelector('input[name="precio"]:checked').value,
        provincia: document.querySelector('input[name="provincia"]:checked').value,
        facilidad: document.querySelector('input[name="facilidad"]:checked').value,
    };

    // Prepare the POST request
    let urlLocal = 'http://localhost/preorder/preorder_filter';
    let url = 'https://addled-radiuses.000webhostapp.com/preorder/preorder_filter';
    let options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(registro),
    };

    let response = await fetch(urlLocal, options);
    let responseData = await response.json();

    // Esta consulta devuelve
    if (responseData.success){

        if (responseData.result.length > 0) {

            console.log('buscando tu reserva...');

            // Mensaje enviado por el servidor
            console.log('Mensaje del servidor:', responseData.message);

            // Obtenemos el scrollpane mediante el id
            const restaurantListName = document.getElementById('preorder-list');
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

            restaurantListName.innerHTML = htmlContent;

        }
  
    }
        
    else {

        responseData.message = "<p><strong> Ups! </strong> No existe ninguna reserva con esas condiciones :(, inténtelo de nuevo.</p>";

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
            }, 1000);
        }, 3000);
    }// seguir puliendo el visual de esto, por fortuna es igual que la busqueda de reservas
  
}
