const registroFormulario = document.getElementById('registroForm');
registroFormulario.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
    registroFormularioSubmit();
});

function changeClass() {
    // Obtener el elemento por su ID
    let nameInput = document.getElementById("nombre");
    let lastNameInput = document.getElementById("apellido");
    let emailInput = document.getElementById("correo");
    let phoneNumberInput = document.getElementById("telefono");

    // Agregar un event listener al input del nombre
    nameInput.addEventListener('input', function() {
        // Validar el formulario y cambiar las clases según el resultado
        let validationName = validateName(nameInput.value);

        if (validationName === false) {
            nameInput.classList.add("is-invalid");
        } else {
            nameInput.classList.remove("is-invalid");
        }
    });

    // Agregar un event listener al input del apellido
    lastNameInput.addEventListener('input', function() {
        // Validar el formulario y cambiar las clases según el resultado
        let validationLastName = validateName(lastNameInput.value);

        if (validationLastName === false) {
            lastNameInput.classList.add("is-invalid");
        } else {
            lastNameInput.classList.remove("is-invalid");
        }
    });

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

    // Agregar un event listener al input del telefono
    phoneNumberInput.addEventListener('blur', function() {
        // Validar el formulario y cambiar las clases según el resultado
        let validationPhoneNumber = validatePhoneNumber(phoneNumberInput.value);

        if (validationPhoneNumber === false) {
            phoneNumberInput.classList.add("is-invalid");
        } else {
            phoneNumberInput.classList.remove("is-invalid");
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

function validateName(value) {
    let name = value;

    // Expresión regular para verificar si el nombre contiene solo letras
    let nameRegex = /^[a-zA-Z]+$/;

    if (!nameRegex.test(name)) {
        return false;
    } else {
        return true;
    }
}

function validatePhoneNumber(value) {
    let phoneNumber = value;

    //alert(phoneNumber);

    // Expresión regular para verificar si el numero contiene 7 u 8 digitos separados por guion
    let phoneNumberRegex = /^(?:\d{4}-\d{4}|\d{3}-\d{4}|)$/;

    if (!phoneNumberRegex.test(phoneNumber)) {
        return false;
    } else {
        return true;
    }
}

async function registroFormularioSubmit() {
    let registro = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        telefono: document.getElementById('telefono').value,
        direccion: document.getElementById('direccion').value,
        correo: document.getElementById('correo').value,
        contraseña: document.getElementById('contraseña').value,
    };

    // validar los campos necesarios
    let validationName = validateName(registro.nombre);
    let validationLastName = validateName(registro.apellido);
    let validationEmail = validateEmail(registro.correo);
    let validationPhoneNumber = validatePhoneNumber(registro.telefono);

    if (validationName === true && validationLastName === true && validationEmail === true && validationPhoneNumber === true){
        
        // Prepare the POST request
        let urlLocal = 'http://localhost/user/create';
        let url = 'https://addled-radiuses.000webhostapp.com/user/create'
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

            // redireccionar a login
            window.location.href='http://localhost/user/login';
            //window.location.href='https://addled-radiuses.000webhostapp.com/user/login'       
        }
        else {
            responseData.message = "<p><strong> Ups! </strong> Ese correo electrónico está asociado a una cuenta existente.</p>";
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

