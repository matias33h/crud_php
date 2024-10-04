<?php
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Manejo de la imagen
    $foto_perfil = null; // Inicializa la variable

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $directorio = '../uploads'; // Directorio donde guardar las imágenes
        $archivo = $_FILES['foto_perfil']['name'];
        $ruta = $directorio . basename($archivo);
        
        // Mueve el archivo subido a la carpeta correspondiente
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta)) {
            $foto_perfil = $ruta; // Guarda la ruta de la imagen
        } else {
            echo "Error al subir la imagen.";
        }
    }

    // Insertar el usuario en la base de datos con la imagen
    $sql = "INSERT INTO usuarios (nombre, email, password, img_perfil) VALUES (:nombre, :email, :password, :img_perfil)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nombre' => $nombre,
        'email' => $email,
        'password' => $password,
        'img_perfil' => $foto_perfil // Asegúrate de que esta variable está definida
    ]);

    header('Location: mostrar.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Crear Usuario</title>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Crear Nuevo Usuario</h2>

    <form method="POST" action="create.php" enctype="multipart/form-data" class="border p-4 bg-white shadow-sm rounded">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa el nombre" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa el email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa la contraseña" required>
        </div>

        <div class="mb-3">
            <label for="foto_perfil" class="form-label">Foto de Perfil</label>
            <input type="file" name="foto_perfil" id="foto_perfil" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success w-100">Crear Usuario</button>
        <a href="mostrar.php" class="btn btn-secondary w-100 mt-3">Lista de Usuarios</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
