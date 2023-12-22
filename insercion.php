<?php

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $id = $_POST['id'];

    // Validar y limpiar datos si es necesario

    $stmt = $conexion->prepare("INSERT INTO docproydetalle (Titulo, Id) VALUES (:titulo, :id)");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    include("index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Datos</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Insertar Datos</h2>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="id" class="form-label">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Insertar Datos</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
