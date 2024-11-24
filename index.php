<?php
// Incluir los archivos necesarios
require_once 'database.php';
require_once 'usuario.php';

// Crear la conexión a la base de datos
$db = new $usuario();
$conn = $db->conectar();

// Crear una instancia de la clase Usuario
$usuario = new Usuario($conn);

// Mensaje de éxito o error
$mensaje = "";

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar'])) {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Intentar agregar el usuario
    if ($usuario->crear($nombre, $email, $telefono)) {
        $mensaje = "Usuario agregado exitosamente.";
    } else {
        $mensaje = "Error al agregar el usuario.";
    }
}

// Obtener la lista de usuarios
$usuarios = $usuario->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
        .mensaje {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
    </style>
</head>
<body>
<h1>Gestión de Usuarios</h1>

<?php if (!empty($mensaje)): ?>
    <div class="mensaje"><?= $mensaje ?></div>
<?php endif; ?>

<!-- Formulario para agregar usuario -->
<form method="POST">
    <h2>Agregar Usuario</h2>
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telefono">Teléfono:</label><br>
    <input type="text" id="telefono" name="telefono" required><br><br>

    <button type="submit" name="agregar">Agregar Usuario</button>
</form>

<!-- Tabla de usuarios -->
<h2>Lista de Usuarios</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Registrado En</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($usuarios)): ?>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['id']) ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['telefono']) ?></td>
                <td><?= htmlspecialchars($u['registrado_en']) ?></td>
                <td>
                    <!-- Enlaces para editar o eliminar -->
                    <a href="editar.php?id=<?= htmlspecialchars($u['id']) ?>">Editar</a> |
                    <a href="eliminar.php?id=<?= htmlspecialchars($u['id']) ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No hay usuarios registrados.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
