this.users_id = document.getElementById('users_id');
this.correo = document.getElementById('correo');
this.password = document.getElementById('password');
this.nombres = document.getElementById('nombres');
this.apellidos = document.getElementById('apellidos');
this.facultad = document.getElementById('facultad');
this.carrera = document.getElementById('carrera');


//------------------------------------------------------esta funcion no sirve, guarda sin hacer hash------------------------------
this.guardarUsers = () => {
    var form = new FormData();
    form.append('users_id', this.users_id.value);
    form.append('correo', this.correo.value);
    form.append('password', this.password.value);
    form.append('nombres', this.nombres.value);
    form.append('apellidos', this.apellidos.value);
    form.append('facultad', this.facultad.value);
    form.append('carrera', this.carrera.value);

    if (this.users_id.value === "") {
        fetch(`../controllers/controllerUsers.php?method=guardarUsers`, {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Añadido con exito");
                this.listadoUsers();
                this.limpiarUsers();
            })
            .catch((error) => console.log(error));
    } else {
        fetch("../controllers/controllerUsers.php?method=actualizarUsers", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Actualizado con exito");
                this.listadoUsers();
                this.limpiarUsers();
            })
            .catch((error) => console.log(error));
    }

};

this.editarUsers = (users_id) => {
    var form = new FormData();
    form.append('users_id', users_id);
    fetch("../controllers/controllerUsers.php?method=editarUsers", {
        method: "POST",
        body: form,
    })
        .then((res) => res.json())
        .then((data) => {
            this.users_id.value = data.users_id;
            this.correo.value = data.correo;
            this.nombres.value = data.nombres;
            this.apellidos.value = data.apellidos;
            this.facultad.value = data.facultad;
            this.carrera.value = data.carrera;

        })
        .catch((error) => console.log(error));

};

this.limpiarUsers = () => {
    this.correo.value = '';
    this.password.value = '';
    this.users_id.value = "";
    this.nombres.value = "";
    this.apellidos.value = "";
    this.facultad.value = "";
    this.carrera.value = "";
};

this.eliminarUsers = (id) => {
    if (confirm(`Está seguro de querer eliminar el usuario #${id}?`)) {
        var form = new FormData();
        form.append('id', id);
        fetch("../controllers/controllerUsers.php?method=eliminarUsers", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Eliminado con exito");
                this.listadoUsers();
            })
            .catch((error) => console.log(error));
    }
};

this.listadoUsers = () => {
    fetch(`../controllers/controllerUsers.php?method=listadoUsers`)
        .then((res) => res.json())
        .then((data) => {
            this.tbody_users.innerHTML = "";
            data.forEach((item) => {
                this.tbody_users.innerHTML += `
                    <tr>
                        <td>${item.users_id}</td>
                        <td>${item.correo}</td>
                        <td>${item.nombres}</td>
                        <td>${item.apellidos}</td>
                        <td>${item.facultad}</td>
                        <td>${item.carrera}</td>
                        <td>
                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editarUsers(${item.users_id})">Editar</a>

                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="eliminarUsers(${item.users_id})">Eliminar</a>
                        </td>
                    </tr>
                `;
            });
        })
        .catch((error) => console.log(error));
};

listadoUsers();