const correo = document.getElementById('correo');
const emailInst = document.getElementById('emailInst');

const form = document.getElementById('register_form');

if (form !== null) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let mail = correo.value + emailInst.value;
        localStorage.setItem('mail', mail);
        e.target.submit();
    });
}

const form2 = document.getElementById('register2_form');
const password = document.getElementById('password');/* 
const nombres = document.getElementById('nombres');
const apellidos = document.getElementById('nombres');
const facultad = document.getElementById('facultad');
const carrera = document.getElementById('carrera'); */

if (form2 !== null) {
    form2.addEventListener('submit', (e) => {
        e.preventDefault();

        let mail = localStorage.getItem('mail');

        var datos = new FormData();
        datos.append('codigo_correo', mail);
        fetch("../controllers/controllerUsers.php?method=obtenerUserConfir", {
            method: "POST",
            body: datos,
        })
            .then((res) => res.json())
            .then((data) => {
                correo.value = mail;
                password.value = data.password;
                e.target.submit();
            })
            .catch((error) => console.log(error));

        //

        /* var datos2 = new FormData();
        datos2.append('correo', correo.value);
        datos2.append('password', password.value);
        datos2.append('nombres', nombres.value);
        datos2.append('apellidos', apellidos.value);
        datos2.append('facultad', facultad.value);
        datos2.append('carrera', carrera.value);
        fetch(`../controllers/controllerUsers.php?method=guardarUsers`, {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
            })
            .catch((error) => console.log(error)); */

    })
}
