<?php 
require '../config/config.php';

$sql = "SELECT * FROM usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista de Usuarios</title>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Lista de Usuarios</h2>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td>
                        <a href="update.php?id=<?= $usuario['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="delete.php?id=<?= $usuario['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center">
        <a href="create.php" class="btn btn-primary">Agregar nuevo usuario</a>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>




<!-- ejemplo de como vienen los datos cunado fetchAll(); -->

<!-- $usuarios = [
    [
        'id' => 1,
        'nombre' => 'Juan',
        'email' => 'juan@example.com',
        'password' => '$2y$10$abcdef...'  // Password hasheado
    ],
    [
        'id' => 2,
        'nombre' => 'Maria',
        'email' => 'maria@example.com',
        'password' => '$2y$10$ghijkl...'
    ],
    [
        'id' => 3,
        'nombre' => 'Carlos',
        'email' => 'carlos@example.com',
        'password' => '$2y$10$mnopqr...'
    ]
]; -->