<?php
require '../config/config.php';

if (isset($_POST['confirmar_eliminacion']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    header('Location: mostrar.php');
    exit;
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Consultamos el nombre del usuario para mostrarlo en el mensaje de confirmación
    $sql = "SELECT nombre FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Eliminar Usuario</title>
</head>
<body class="bg-light">

<div class="container mt-5">
    <?php if ($usuario): ?>

        <div class="alert alert-warning text-center" role="alert">
            ¿Estás seguro de que deseas eliminar al usuario <strong><?= htmlspecialchars($usuario['nombre']) ?></strong>?
        </div>

        <div class="text-center">
            <form method="POST" action="delete.php">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" name="confirmar_eliminacion" class="btn btn-danger">Eliminar</button>
                <a href="read.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center" role="alert">
            El usuario no existe o ya ha sido eliminado.
        </div>
        <div class="text-center">
            <a href="mostrar.php" class="btn btn-secondary">Volver a la Lista</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
