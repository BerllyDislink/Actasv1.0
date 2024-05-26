<!DOCTYPE html>
<html lang="es">

<?php
include_once 'header.php'
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>


<body>
    <div class="container">
        <div class="justify-content-center p-5">

            <div>
                <h3>Usuarios</h3>
                <hr />
                <form action="javascript:void(0);" onsubmit="guardarUsers()">
                    <input type="hidden" id="users_id" />

                    <label for="correo">Correo</label>
                    <input type="text" class="form-control" id="correo" placeholder="Correo" autofocus required />

                    <label for="password">Contraseña</label>
                    <input type="text" class="form-control" id="password" placeholder="Contraseña" autofocus required />

                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" id="nombres" placeholder="Nombres" autofocus required />

                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" placeholder="Apellidos" autofocus required />

                    <label for="facultad">Facultad</label>
                    <input type="text" class="form-control" id="facultad" placeholder="Facultad" autofocus required />

                    <label for="carrera">Carrera</label>
                    <input type="text" class="form-control" id="carrera" placeholder="Carrera" autofocus required />
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </div>
                </form>
                <br />
                <h5>Listado</h5>
                <hr />
                <table class="table">
                    <thead>
                        <tr>
                            <th># id</th>
                            <th>Correo</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Facultad</th>
                            <th>Carrera</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_users"></tbody>
                </table>
            </div><br><br>


            <div>
                <h3>Actas</h3>
                <hr />
                <form action="javascript:void(0);" onsubmit="guardarActas()">
                    <input type="hidden" id="actas_id" />
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre del acta" autofocus
                        required />
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" autofocus
                        required />
                    <label for="fecha_de_creacion">Fecha de creacion</label>
                    <input type="date" class="form-control" id="fecha_de_creacion" autofocus required />
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </div>
                </form>
                <br />
                <h5>Listado</h5>
                <hr />
                <table class="table">
                    <thead>
                        <tr>
                            <th># id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Fecha de creacion</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_actas"></tbody>
                </table>
            </div><br><br>


            <div>
                <h3>Compromisos</h3>
                <hr />
                <form action="javascript:void(0);" onsubmit="guardarCompro()">
                    <input type="hidden" id="compromisos_id" />
                    <label for="nombreCompro">Nombre</label>
                    <input type="text" class="form-control" id="nombreCompro" placeholder="Nombre del compromiso"
                        autofocus required />
                    <label for="descripcionCompro">Descripcion</label>
                    <input type="text" class="form-control" id="descripcionCompro" placeholder="Descripcion" autofocus
                        required />
                    <label for="estado">Estado</label>
                    <select class="form-select" name="estado" id="estado">
                        <option value="1">Abierto</option>
                        <option value="2">Pendiente</option>
                        <option value="3">Cerrado</option>
                    </select><br>
                    <label for="acta_compro">Acta</label>
                    <select class="form-select" name="acta_compro" id="acta_compro"
                        onchange="mostrarResponsables()"></select>
                    <br>
                    <label for="responsable">Responsable</label>
                    <select class="form-select" name="responsable" id="responsable"></select>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </div>
                </form>
                <br />
                <h5>Listado</h5>
                <hr />
                <table class="table">
                    <thead>
                        <tr>
                            <th># id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acta</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_compro"></tbody>
                </table>
            </div><br><br>


            <div>
                <h3>Asistentes</h3>
                <hr />
                <form action="javascript:void(0);" onsubmit="guardarAsist()">
                    <input type="hidden" id="editar_asist" />

                    <label for="r_id_acta">ID del acta</label>
                    <select class="form-select" name="r_id_acta" id="r_id_acta"></select><br>

                    <label for="r_id_user">ID del usuario</label>
                    <select class="form-select" name="r_id_user" id="r_id_user"></select><br>

                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </div>
                </form>
                <br />
                <h5>Listados</h5>
                <hr />

                <div id="listadoActas">
                    <!-- <table class="table">
                        <thead>
                            <tr>
                                <th># id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Fecha de creacion</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_asist"></tbody>
                    </table> -->
                </div>

            </div><br><br>


        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="../assets/fUsers.js"></script>
    <script src="../assets/fActas.js"></script>
    <script src="../assets/fCompromisos.js"></script>
    <script src="../assets/fAsistentes.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>