async function preorderList() {

    let urlLocal = 'http://localhost/preorder/read_all';
    let url = 'https://addled-radiuses.000webhostapp.com/preorder/read_all';

    let response = await fetch(urlLocal);
    let responseData = await response.json();
    
    // si la respuesta es TRUE, es decir hay reservas
    if (responseData.success){
        const preorderListName = document.getElementById('preorder-list');

        responseData.result.forEach(item => {
            preorderListName.insertAdjacentHTML('beforeend',`<div class="active rounded-4">
            <p class="ms-3 mt-2" style="font-size: 1.45em;">${item.nombre}</p>
            <div class="container d-flex justify-content-end">
                <a type="button" href="<?php echo LOCAL_HOST; ?>/preorder/edit/?id=${item.cod_reserva}" class="d-flex justify-content-center align-items-center mx-md-3 mx-2  btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px"><i class="bi bi-pencil-square"></i></a>
                <a type="button" href="<?php echo LOCAL_HOST; ?>/preorder/cancel/?id=${item.cod_reserva}" class="d-flex justify-content-center align-items-center btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px"><i class="bi bi-trash-fill" style="color: red;"></i></a>
            </div>
        </div>`)
        });
    }
    // si la respuesta es FALSE, es decir no hay reservas
    else {
        const preorderListName = document.getElementById('preorder-list');

        preorderListName.insertAdjacentHTML('beforeend',`<div class="active rounded-4">
        <p class="ms-3 mt-2" style="font-size: 1.45em;">Haz tu Reserva</p>
        <div class="container d-flex justify-content-end">
        </div>
        </div>`);
    }   
}

function verificarURL() {
    // Obtén la URL actual
    var urlActual = window.location.href;

    // Verifica la URL y realiza acciones en consecuencia
    if (urlActual.includes("search")) {
        console.log("Estás en preorder/search");
        preorderList();
    } 
}

verificarURL();
