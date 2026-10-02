<?php

// ======================================================
// PROCESAR.PHP
// Este archivo recibe y valida los datos del formulario
// ======================================================


// Verificamos que el formulario haya sido enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // ==================================================
    // 1. RECIBIR Y LIMPIAR LOS DATOS
    // ==================================================

    // Limpiar y normalizar el nombre
    $nombre = trim($_POST["nombre"]);
    $nombre = strip_tags($nombre);
    $nombre = htmlspecialchars($nombre);
    $nombre = ucwords(strtolower($nombre));


    // Limpiar y normalizar el apellido
    $apellido = trim($_POST["apellido"]);
    $apellido = strip_tags($apellido);
    $apellido = htmlspecialchars($apellido);
    $apellido = ucwords(strtolower($apellido));


    // Limpiar la identificacion
    $identificacion = trim($_POST["identificacion"]);
    $identificacion = strip_tags($identificacion);
    $identificacion = htmlspecialchars($identificacion);
    $identificacion = strtoupper($identificacion);


    // Recibir fecha de nacimiento
    $fechaNacimiento = $_POST["fecha_nacimiento"];


    // Recibir sexo
    $sexo = $_POST["sexo"];



    // ==================================================
    // 2. VALIDAR QUE LOS CAMPOS NO ESTEN VACIOS
    // ==================================================

    if (
        empty($nombre) ||
        empty($apellido) ||
        empty($identificacion) ||
        empty($fechaNacimiento) ||
        empty($sexo)
    ) {

        die("Error: Todos los campos son obligatorios.");
    }



    // ==================================================
    // 3. CALCULAR LA EDAD
    // ==================================================

    // Convertimos la fecha de nacimiento a un objeto de fecha
    $fechaNacimientoObjeto = new DateTime($fechaNacimiento);

    // Obtenemos la fecha actual
    $fechaActual = new DateTime();

    // Calculamos la diferencia entre las dos fechas
    $edad = $fechaActual->diff($fechaNacimientoObjeto)->y;



    // ==================================================
    // 4. VALIDAR QUE LA EDAD ESTE ENTRE 18 Y 70 AÑOS
    // ==================================================

    if ($edad < 18 || $edad > 70) {

        die("Error: El aspirante debe tener entre 18 y 70 años.");

    }



    // ==================================================
    // 5. VALIDAR QUE SE HAYA SUBIDO UNA FOTO
    // ==================================================

    if (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] != 0) {

        die("Error: Debe seleccionar una fotografia.");

    }



    // ==================================================
    // 6. OBTENER INFORMACION DE LA FOTO
    // ==================================================

    // Nombre original de la fotografia
    $nombreFoto = basename($_FILES["foto"]["name"]);

    // Ubicacion temporal de la fotografia
    $archivoTemporal = $_FILES["foto"]["tmp_name"];

    // Obtener la extension del archivo
    $extension = strtolower(pathinfo($nombreFoto, PATHINFO_EXTENSION));



    // ==================================================
    // 7. EXTENSIONES DE IMAGEN PERMITIDAS
    // ==================================================

    $extensionesPermitidas = [
        "jpg",
        "jpeg",
        "png",
        "gif",
        "webp"
    ];



    // ==================================================
    // 8. VALIDAR LA EXTENSION DE LA FOTO
    // ==================================================

    if (!in_array($extension, $extensionesPermitidas)) {

        die("Error: El formato de la imagen no esta permitido.");

    }



    // ==================================================
    // 9. CARPETA DONDE SE GUARDARA LA FOTO
    // ==================================================

    $carpetaDestino = "uploaded_files/";


    // Verificamos que la carpeta exista
    if (!is_dir($carpetaDestino)) {

        die("Error: La carpeta uploaded_files no existe.");

    }



    // ==================================================
    // 10. CREAR UN NOMBRE SEGURO PARA LA FOTO
    // ==================================================

    // Creamos un nombre unico para evitar reemplazar
    // fotografias que tengan el mismo nombre

    $nuevoNombreFoto = uniqid("aspirante_") . "." . $extension;


    // Ruta completa donde se guardara
    $rutaDestino = $carpetaDestino . $nuevoNombreFoto;



    // ==================================================
    // 11. GUARDAR LA FOTO
    // ==================================================

    if (move_uploaded_file($archivoTemporal, $rutaDestino)) {

        // Si la fotografia se guardo correctamente

        ?>

        <!DOCTYPE html>

        <html lang="es">

        <head>

            <meta charset="UTF-8">

            <meta name="viewport"
                  content="width=device-width, initial-scale=1.0">

            <title>Registro completado</title>

            <!-- Bootstrap -->
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
                rel="stylesheet">

<!-- Estilos personalizados -->
<style>

    /* Fondo de toda la página */
    body {
        background-color: #fff5fa !important;
    }

    /* Tarjeta de resultados */
    .card {
        background-color: #fffafd;
        border: 1px solid #e8c7df;
    }

    /* Encabezado "Registro completado" */
    .card-header {
        background-color: #d8b4e2 !important;
        color: #4a3055 !important;
    }

    /* Título Datos del Aspirante */
    .card-body h4 {
        color: #8e5b87;
    }

    /* Botón Registrar otro aspirante */
    .btn-primary {
        background-color: #c98fbd !important;
        border-color: #c98fbd !important;
    }

    /* Color del botón al pasar el mouse */
    .btn-primary:hover {
        background-color: #b779aa !important;
        border-color: #b779aa !important;
    }

    /* Borde de la fotografía */
    .img-thumbnail {
        border: 3px solid #d8b4e2;
    }

</style>

        </head>


        <body class="bg-light">


            <main class="container mt-5">


                <div class="card shadow">


                    <!-- Encabezado -->
                    <div class="card-header">

                        <h2>
                            Registro completado
                        </h2>

                    </div>


                    <!-- Informacion del aspirante -->
                    <div class="card-body">


                        <h4>
                            Datos del Aspirante
                        </h4>


                        <p>
                            <strong>Nombre:</strong>
                            <?php echo $nombre; ?>
                        </p>


                        <p>
                            <strong>Apellido:</strong>
                            <?php echo $apellido; ?>
                        </p>


                        <p>
                            <strong>Identificacion:</strong>
                            <?php echo $identificacion; ?>
                        </p>


                        <p>
                            <strong>Fecha de nacimiento:</strong>
                            <?php echo htmlspecialchars($fechaNacimiento); ?>
                        </p>


                        <p>
                            <strong>Edad:</strong>
                            <?php echo $edad; ?> años
                        </p>


                        <p>
                            <strong>Sexo:</strong>
                            <?php echo htmlspecialchars($sexo); ?>
                        </p>

                        <p>
                            <strong>Fotografia:</strong>
                        </p>
                        <img src="<?php echo $rutaDestino; ?>"
                        alt="Foto del aspirante"
                        class="img-thumbnail"
                        style="width: 180px; height: 180px; object-fit: cover;">
                        <p class="mt-2">
                            Foto guardada correctamente.
                        </p>


                        <!-- Boton para regresar -->
                        <a href="index.php"
                           class="btn btn-primary">

                            Registrar otro aspirante

                        </a>


                    </div>

                </div>


            </main>


        </body>

        </html>


        <?php

    } else {

        // Si ocurrio un problema al guardar la fotografia
        echo "Error: No se pudo guardar la fotografia.";

    }


} else {

    // Si alguien intenta entrar directamente a procesar.php
    // sin enviar el formulario

    echo "No se recibieron datos del formulario.";

}

?>