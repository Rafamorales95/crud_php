<?php
require_once 'database.php';
require_once 'usuario.php';

$db = new Database();
$conn = $db->conectar();

$usuario = new Usuario($conn);

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    if ($usuario->crear($nombre, $email, $telefono)) {
        $mensaje = "Usuario creado exitosamente.";
    } else {
        $mensaje = "Error al crear el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        .mensaje {
            margin: 20px 0;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            text-align: center;
        }
        .volver {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        .volver a {
            color: #007BFF;
            text-decoration: none;
        }
        .volver a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h1>Crear Usuario</h1>

<?php if (!empty($mensaje)): ?>
    <div class="mensaje"><?= $mensaje ?></div>
<?php endif; ?>

<form method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required>

    <button type="submit">Crear Usuario</button>
</form>

<div class="volver">
    <a href="index.php">← Volver al inicio</a>
</div>
</body>
</html>
