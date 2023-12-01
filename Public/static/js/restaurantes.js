async function restaurantList() {

    let urlLocal = 'http://localhost/restaurant/read_all';
    let url = 'https://addled-radiuses.000webhostapp.com/restaurant/read_all';

    let response = await fetch(urlLocal);
    let responseData = await response.json();
    
    // si la respuesta es TRUE, es decir hay restaurantes
    if (responseData.success){
        const preorderListName = document.getElementById('restaurant-list');

        responseData.result.forEach(item => {
            preorderListName.insertAdjacentHTML('beforeend',`<div class="active rounded-4">
        <p class="ms-3 mt-2" style="font-size: 1.45em;">${item.nombre}</p>
            <div class="container d-flex justify-content-end">
                <a type="button" href="<?php echo LOCAL_HOST; ?>/restaurant/info/?id=${item.id}" class="d-flex justify-content-center align-items-center mx-md-3 mx-2  btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px">Ver más</a>
                <a type="button" href="<?php echo LOCAL_HOST; ?>/preorder/new" class="d-flex justify-content-center text-center align-items-center btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px">Reservar</a>
            </div>
        </div>`)
        });
    }
}

async function restaurantDropdown() {

    let urlLocal = 'http://localhost/restaurant/read_all';
    let url = 'https://addled-radiuses.000webhostapp.com/restaurant/read_all';

    let response = await fetch(urlLocal);
    let responseData = await response.json();
    
    // si la respuesta es TRUE, es decir hay restaurantes
    if (responseData.success){
        const preorderDropdowName = document.getElementById('restaurantes');

        // obtener el id de la reserva mediante el parametro 
        let param1 = getSearchParam("id");
       
        responseData.result.forEach(item => {
            // si el id de la reserva Corresponde con el option se selecciona por defecto
            if (param1 == item.id){
                preorderDropdowName.insertAdjacentHTML('beforeend',`<option value="${item.id}" selected >${item.nombre}</option>`);
            }
            else{
                preorderDropdowName.insertAdjacentHTML('beforeend',`<option value="${item.id}">${item.nombre}</option>`);
            }
        });
    }
}

// verificar la url para ejecutar la funcion solo cuando es necesario
function verifyURL() {
    // Obtén la URL actual
    var urlActual = window.location.href;

    // Verifica la URL y realiza acciones en consecuencia
    if (urlActual.includes("search")) {
        console.log("Estás en restaurant/search");
        restaurantList();
    } 
    else if (urlActual.includes("new") || urlActual.includes("edit") || urlActual.includes("cancel")) {
        console.log("Estás en preorder/new, preorder/edit o preorder/cancel");
        restaurantDropdown();
    } 
}

// funcion para buscar parametros si se necesita
function getSearchParam(name) {
    let params = new URLSearchParams(window.location.search);
    return params.get(name);
}

verifyURL();


