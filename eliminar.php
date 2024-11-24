<?php
require_once 'database.php';
require_once 'usuario.php';

$db = new Database();
$conn = $db->conectar();

$usuario = new Usuario($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el usuario
    if ($usuario->eliminar($id)) {
        $mensaje = "Usuario eliminado exitosamente.";
    } else {
        $mensaje = "Error al eliminar el usuario.";
    }
} else {
    die("ID no proporcionado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        .mensaje {
            margin: 20px 0;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            display: inline-block;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
        .volver {
            margin-top: 20px;
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
<h1>Eliminar Usuario</h1>

<?php if (!empty($mensaje)): ?>
    <div class="mensaje <?= isset($error) && $error ? 'error' : '' ?>"><?= $mensaje ?></div>
<?php endif; ?>

<div class="volver">
    <a href="index.php">← Volver al inicio</a>
</div>
</body>
</html>
