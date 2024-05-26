this.actas_id = document.getElementById('actas_id');
this.nombre = document.getElementById('nombre');
this.descripcion = document.getElementById('descripcion');
this.fecha_de_creacion = document.getElementById('fecha_de_creacion');


this.guardarActas = () => {
    var form = new FormData();
    form.append('actas_id', this.actas_id.value);
    form.append('nombre', this.nombre.value);
    form.append('descripcion', this.descripcion.value);
    form.append('fecha_de_creacion', this.fecha_de_creacion.value);

    if (this.actas_id.value === "") {
        fetch(`../controllers/controllerActas.php?method=guardarActas`, {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Añadido con exito");
                this.listadoActas();
                this.limpiarActas();
            })
            .catch((error) => console.log(error));
    } else {
        fetch("../controllers/controllerActas.php?method=actualizarActas", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Actualizado con exito");
                this.listadoActas();
                this.limpiarActas();
            })
            .catch((error) => console.log(error));
    }

};

this.editarActas = (actas_id) => {
    var form = new FormData();
    form.append('actas_id', actas_id);
    fetch("../controllers/controllerActas.php?method=editarActas", {
        method: "POST",
        body: form,
    })
        .then((res) => res.json())
        .then((data) => {
            this.actas_id.value = data.actas_id;
            this.nombre.value = data.nombre;
            this.descripcion.value = data.descripcion;
            this.fecha_de_creacion.value = data.fecha_de_creacion;
        })
        .catch((error) => console.log(error));

};

this.limpiarActas = () => {
    this.nombre.value = '';
    this.descripcion.value = '';
    this.fecha_de_creacion.value = '';
    this.actas_id.value = "";
};

this.eliminarActas = (id) => {
    if (confirm(`Está seguro de querer eliminar la acta #${id}?`)) {
        var form = new FormData();
        form.append('id', id);
        fetch("../controllers/controllerActas.php?method=eliminarActas", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Eliminado con exito");
                this.listadoActas();
            })
            .catch((error) => console.log(error));
    }
};

this.listadoActas = () => {
    fetch(`../controllers/controllerActas.php?method=listadoActas`)
        .then((res) => res.json())
        .then((data) => {
            this.tbody_actas.innerHTML = "";
            data.forEach((item) => {
                this.tbody_actas.innerHTML += `
                    <tr>
                        <td>${item.actas_id}</td>
                        <td>${item.nombre}</td>
                        <td>${item.descripcion}</td>
                        <td>${item.fecha_de_creacion}</td>
                        <td>
                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editarActas(${item.actas_id})">Editar</a>

                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="eliminarActas(${item.actas_id})">Eliminar</a>
                        </td>
                    </tr>
                `;
            });

        })
        .catch((error) => console.log(error));
};

listadoActas();