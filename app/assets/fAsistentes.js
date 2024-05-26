this.r_id_acta = document.getElementById('r_id_acta');
this.r_id_user = document.getElementById('r_id_user');
this.editar_asist = document.getElementById('editar_asist');
this.respaldoActa = "";
this.respaldoUser = "";
this.listadoActas = document.getElementById('listadoActas');

this.guardarAsist = () => {
    var form = new FormData();
    form.append('r_id_acta', this.r_id_acta.value);
    form.append('r_id_user', this.r_id_user.value);
    limpiarAsist();

    if (this.editar_asist.value === "") {
        fetch(`../controllers/controllerRela.php?method=guardarAsist`, {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Añadido con exito");
                this.listadoAsist();
                this.limpiarAsist();
            })
            .catch((error) => console.log(error));
    } else {
        fetch("../controllers/controllerRela.php?method=actualizarAsist", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Actualizado con exito");
                this.listadoAsist();
                this.limpiarAsist();
            })
            .catch((error) => console.log(error));

        eliminarAsist(respaldoActa, respaldoUser);
    }

};

this.editarAsist = (actas_id, users_id) => {
    this.r_id_acta.value = actas_id;
    this.r_id_user.value = users_id;
    this.editar_asist.value = "hola";
    this.respaldoActa = actas_id;
    this.respaldoUser = users_id;
};

this.limpiarAsist = () => {
    this.editar_asist.value = "";
    this.r_id_acta.value = "";
    this.r_id_user.value = '';
};

this.eliminarAsist = (actas_id, users_id) => {
    if (confirm(`Está seguro de querer eliminar la relacion entre el acta #${actas_id} y el estudiante #${users_id}?`)) {
        var form = new FormData();
        form.append('actas_id', actas_id);
        form.append('users_id', users_id);
        fetch("../controllers/controllerRela.php?method=eliminarAsist", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Eliminado con exito");
                this.listadoAsist();
            })
            .catch((error) => console.log(error));
    }
};

this.mostrarSelect = () => {
    fetch("../controllers/controllerActas.php?method=listadoActas")
        .then((res) => res.json())
        .then((data) => {
            this.r_id_acta.innerHTML = "";
            data.forEach((item) => {
                this.r_id_acta.innerHTML += `
                    <option value="${item.actas_id}">${item.actas_id}</option>
                `;
            });
        })
        .catch((error) => console.log(error));

    fetch(`../controllers/controllerUsers.php?method=listadoUsers`)
        .then((res) => res.json())
        .then((data) => {
            this.r_id_user.innerHTML = "";
            data.forEach((item) => {
                this.r_id_user.innerHTML += `
                    <option value="${item.users_id}">${item.users_id}</option>
                `;
            });
        })
        .catch((error) => console.log(error));
};


this.listadoAsist = () => {
    fetch(`../controllers/controllerRela.php?method=listadoAsist`)
        .then((res) => res.json())
        .then((data) => {
            let acta;
            this.listadoActas.innerHTML = "";
            data.forEach((item) => {
                if (acta != item.fk_actas_id) {
                    // Crea un nuevo elemento de tabla por cada acta
                    let tabla = document.createElement("table");
                    tabla.classList.add("table");
                    tabla.innerHTML = `
                        <thead>
                            <tr>
                                <th>#id Asistentes del acta #${item.fk_actas_id}</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_asist_${item.fk_actas_id}"></tbody>`;
                    this.listadoActas.appendChild(tabla);
                }

                // Agrega la fila de asistente a la tabla correspondiente
                let tbodyAsist = document.getElementById(`tbody_asist_${item.fk_actas_id}`);
                tbodyAsist.innerHTML += `
                    <tr>
                        <td>${item.fk_users_id}</td>
                        <td>
                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editarAsist(${item.fk_actas_id}, ${item.fk_users_id})">Editar</a>
                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="eliminarAsist(${item.fk_actas_id}, ${item.fk_users_id})">Eliminar</a>
                        </td>
                    </tr>`;

                acta = item.fk_actas_id;
            });
        })
        .catch((error) => console.log(error));
};


listadoAsist();
mostrarActas();
mostrarSelect();
