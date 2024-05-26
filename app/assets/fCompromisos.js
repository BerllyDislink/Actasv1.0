this.compromisos_id = document.getElementById('compromisos_id');
this.nombre = document.getElementById('nombreCompro');
this.descripcion = document.getElementById('descripcionCompro');
this.estado = document.getElementById('estado');
this.acta_compro = document.getElementById('acta_compro');
this.responsable = document.getElementById('responsable');

this.guardarCompro = () => {
    var form = new FormData();
    form.append('compromisos_id', this.compromisos_id.value);
    form.append('nombre', this.nombre.value);
    form.append('descripcion', this.descripcion.value);
    form.append('estado', this.estado.value);
    form.append('acta_compro', this.acta_compro.value);
    form.append('responsable', this.responsable.value);

    if (this.compromisos_id.value === "") {
        fetch(`../controllers/controllerCompro.php?method=guardarCompro`, {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Añadido con exito");
                this.listadoCompro();
                this.limpiarCompro();
            })
            .catch((error) => console.log(error));
    } else {
        fetch("../controllers/controllerCompro.php?method=actualizarCompro", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Actualizado con exito");
                this.listadoCompro();
                this.limpiarCompro();
            })
            .catch((error) => console.log(error));
    }

};

this.editarCompro = (compromisos_id) => {
    var form = new FormData();
    form.append('compromisos_id', compromisos_id);
    fetch("../controllers/controllerCompro.php?method=editarCompro", {
        method: "POST",
        body: form,
    })
        .then((res) => res.json())
        .then((data) => {
            this.compromisos_id.value = data.compromisos_id;
            this.nombre.value = data.nombre;
            this.descripcion.value = data.descripcion;
            this.estado.value = data.estado;
            this.acta_compro.value = data.fk_actas_id;
            this.responsable.value = data.responsable_users_id;
        })
        .catch((error) => console.log(error));

};

this.limpiarCompro = () => {
    this.compromisos_id.value = "";
    this.nombre.value = '';
    this.descripcion.value = '';
    this.estado.value = '';
    this.acta_compro.value = "";
    this.responsable.value = "";
};

this.eliminarCompro = (id) => {
    if (confirm(`Está seguro de querer eliminar la acta #${id}?`)) {
        var form = new FormData();
        form.append('id', id);
        fetch("../controllers/controllerCompro.php?method=eliminarCompro", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Eliminado con exito");
                this.listadoCompro();
            })
            .catch((error) => console.log(error));
    }
};

this.mostrarActas = () => {
    fetch("../controllers/controllerRela.php?method=listaIdActas")
        .then((res) => res.json())
        .then((data) => {
            this.acta_compro.innerHTML = "";
            data.forEach((item) => {
                this.acta_compro.innerHTML += `
                <option value="${item.actas_id}">${item.actas_id}</option>
            `;
            });
            mostrarResponsables();
        })
        .catch((error) => console.log(error));
};

this.mostrarResponsables = () => {
    if (this.acta_compro.value != "") {
        var form = new FormData();
        form.append('actas_id', this.acta_compro.value);
        fetch(`../controllers/controllerRela.php?method=listaIdsResponsables`, {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                this.responsable.innerHTML = "";
                data.forEach((item) => {
                    this.responsable.innerHTML += `
                    <option value="${item.fk_users_id}">${item.fk_users_id}</option>
                `;
                });
            })
            .catch((error) => console.log(error));
    }
}

this.listadoCompro = () => {
    fetch(`../controllers/controllerCompro.php?method=listadoCompro`)
        .then((res) => res.json())
        .then((data) => {
            this.tbody_compro.innerHTML = "";
            data.forEach((item) => {
                this.tbody_compro.innerHTML += `
                    <tr>
                        <td>${item.compromisos_id}</td>
                        <td>${item.nombre}</td>
                        <td>${item.descripcion}</td>
                        <td>${item.estado}</td>
                        <td>${item.fk_actas_id}</td>
                        <td>${item.responsable_users_id}</td>
                        <td>
                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editarCompro(${item.compromisos_id})">Editar</a>

                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="eliminarCompro(${item.compromisos_id})">Eliminar</a>
                        </td>
                    </tr>
                `;
            });
        })
        .catch((error) => console.log(error));
};

listadoCompro();
mostrarActas();

