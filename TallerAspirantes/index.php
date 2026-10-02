<?php
// Incluimos el encabezado y el menu de navegacion
include("includes/header.php");
include("includes/navegacion.php");
?>

<!-- Contenido principal de la pagina -->
<main class="container mt-4">

    <!-- Seccion donde estara el formulario -->
    <section>

        <!-- Tarjeta de Bootstrap para organizar el formulario -->
        <div class="card shadow">

            <!-- Encabezado de la tarjeta -->
            <div class="card-header bg-primary text-white">

                <h2 class="mb-0">
                    Formulario de Registro
                </h2>

            </div>

            <!-- Cuerpo de la tarjeta -->
            <div class="card-body">

                <!--
                    Formulario de registro.

                    action="procesar.php":
                    Envia los datos al archivo procesar.php.

                    method="POST":
                    Envia los datos utilizando el metodo POST.

                    enctype="multipart/form-data":
                    Permite enviar archivos, en este caso la fotografia.
                -->
                <form action="procesar.php"
                      method="POST"
                      enctype="multipart/form-data">


                    <!-- ============================= -->
                    <!-- CAMPO NOMBRE -->
                    <!-- ============================= -->

                    <div class="mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            placeholder="Ingrese su nombre"
                            required>

                    </div>


                    <!-- ============================= -->
                    <!-- CAMPO APELLIDO -->
                    <!-- ============================= -->

                    <div class="mb-3">

                        <label class="form-label">
                            Apellido
                        </label>

                        <input
                            type="text"
                            name="apellido"
                            class="form-control"
                            placeholder="Ingrese su apellido"
                            required>

                    </div>


                    <!-- ============================= -->
                    <!-- CAMPO IDENTIFICACION -->
                    <!-- ============================= -->

                    <div class="mb-3">

                        <label class="form-label">
                            Identificacion
                        </label>

                        <input
                            type="text"
                            name="identificacion"
                            class="form-control"
                            placeholder="Ejemplo: 8-123-456"
                            required>

                    </div>


                    <!-- ============================= -->
                    <!-- FECHA DE NACIMIENTO -->
                    <!-- ============================= -->

                    <div class="mb-3">

                        <label class="form-label">
                            Fecha de nacimiento
                        </label>

                        <input
                            type="date"
                            name="fecha_nacimiento"
                            class="form-control"
                            required>

                    </div>


                    <!-- ============================= -->
                    <!-- SEXO -->
                    <!-- ============================= -->

                    <div class="mb-3">

                        <label class="form-label">
                            Sexo
                        </label>

                        <select
                            name="sexo"
                            class="form-select"
                            required>

                            <option value="">
                                Seleccione una opcion
                            </option>

                            <option value="Masculino">
                                Masculino
                            </option>

                            <option value="Femenino">
                                Femenino
                            </option>

                        </select>

                    </div>


                    <!-- ============================= -->
                    <!-- FOTOGRAFIA -->
                    <!-- ============================= -->

                    <div class="mb-3">

                        <label class="form-label">
                            Foto del aspirante
                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.gif,.webp"
                            required>

                    </div>


                    <!-- ============================= -->
                    <!-- BOTON REGISTRAR -->
                    <!-- ============================= -->

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Registrar Aspirante

                    </button>

                </form>
                <!-- Fin del formulario -->

            </div>
            <!-- Fin del cuerpo de la tarjeta -->

        </div>

    </section>

</main>
<!-- Fin del contenido principal -->


<?php
// Incluimos el pie de pagina
include("includes/footer.php");
?>