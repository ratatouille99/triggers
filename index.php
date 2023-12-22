<?php
include("conexion.php");

// Verificar si se envió el formulario de inserción o eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Verificar si se está realizando una inserción
    if (isset($_POST['titulo'], $_POST['id'])) {
        $titulo = $_POST['titulo'];
        $id = $_POST['id'];

        // Validar y limpiar datos si es necesario
        $stmt = $conexion->prepare("INSERT INTO docproydetalle (Titulo, Id) VALUES (:titulo, :id)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redirigir después de la inserción
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Verificar si se está realizando una eliminación
    if (isset($_POST['eliminar'])) {
        $idEliminar = $_POST['eliminar'];

        // Validar y limpiar datos si es necesario
        $stmtEliminar = $conexion->prepare("DELETE FROM docproy WHERE Id = :idEliminar");
        $stmtEliminar->bindParam(':idEliminar', $idEliminar);
        $stmtEliminar->execute();

        // Redirigir después de la eliminación
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

// Fetch and display data from the table
$stmt = $conexion->prepare("SELECT * FROM vista_relacion");
$stmt->execute();
$tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Datos Relacionados</h2>

            <!-- Formulario de Inserción -->
            <form method="post" action="">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Insertar Datos</button>
            </form>

            <br>

            <!-- Visualizar datos de la vista_relacion -->
            <table class="table table-bordered table-striped table-hover">
                <!-- Table header -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo del Proyecto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    <?php foreach ($tableData as $row): ?>
                        <tr>
                            <td><?php echo $row['Id']; ?></td>
                            <td><?php echo $row['Titulo']; ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="eliminar" value="<?php echo $row['Id']; ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
