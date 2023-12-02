const contraFormulario = document.getElementById('contraForm');
contraFormulario.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
    contraFormularioSubmit();
});

function changeClass() {
    // Obtener el elemento por su ID
    let emailInput = document.getElementById("correo");

    // Agregar un event listener al input del correo electrónico
    emailInput.addEventListener('blur', function() {
        // Validar el formulario y cambiar las clases según el resultado
        let validationEmail = validateEmail(emailInput.value);

        if (validationEmail === false) {
            emailInput.classList.add("is-invalid");
        } else {
            emailInput.classList.remove("is-invalid");
        }
    });

}

function validateEmail(value) {
    let email = value;

    // Expresión regular para validar el formato de correo electrónico
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!emailRegex.test(email)) {
        return false;
    } else {
        return true;
    }
}

async function contraFormularioSubmit() {
    let registro = {
        correo: document.getElementById('correo').value,
        contraseña: document.getElementById('contraseña').value,
    };

    // validar los campos necesarios
    let validationEmail = validateEmail(registro.correo);

    if (validationEmail === true){

        // Prepare the POST request
        let urlLocal = 'http://localhost/user/update';
        let url = 'https://addled-radiuses.000webhostapp.com/user/update';
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

            console.log('redireccionado a login...');

            // Mensaje enviado por el servidor
            console.log('Mensaje del servidor:', responseData.message);

            // Mandar el parametro id
            let urlParameter = 'http://localhost/user/login';
            let urlParameterDeploy = 'https://addled-radiuses.000webhostapp.com/user/login';

            // redireccionar a home
            window.location.href=urlParameter;
        }

        else {
            responseData.message = "<p><strong> Ups! </strong> Ha ocurrido un error al intentar cambiar de contraseña, inténtelo de nuevo.</p>";
            //alert(responseData.message);

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
                
        }
            
                     
    }

}

