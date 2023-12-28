<?php
// Obtener el código de invitación de la URL
$codigoInvitacion = $_GET['codigo_invitacion'] ?? '';

// Mostrar el código de invitación en el formulario
if (!empty($codigoInvitacion)) {
    echo '<div class="alert alert-info" role="alert">';
    echo '<p class="mb-0">Código de invitación: <strong>' . htmlspecialchars($codigoInvitacion) . '</strong></p>';
    echo '</div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $codigoReferido = $_POST['codigo_referido'] ?? '';

    // Read existing users data
    $usuarios = file_get_contents('data/usuarios.json');
    $usuarios = json_decode($usuarios, true);

    // Create a new user
    $nuevoUsuario = array(
        "nombre" => $nombre,
        "apellido" => $apellido,
        "edad" => $edad,
        "telefono" => $telefono,
        "usuario" => $usuario,
        "contrasena" => $contrasena,
        "codigo_referido" => $codigoReferido
    );

    // Add the new user to the array
    $usuarios[] = $nuevoUsuario;

    // Save the updated users data to the file
    file_put_contents('data/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));

    echo '<div class="alert alert-success" role="alert">¡Registro exitoso!</div>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            color: #fff;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-dark">
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="path/to/your/logo.png" alt="World Global" class="navbar-logo">
            </a>
            <a class="navbar-brand" href="#">World Global</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Support Button with Font Awesome Icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-question-circle"></i> Soporte
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Registrarse</h2>

        <?php
        // Obtener el código de invitación de la URL
        $codigoInvitacion = $_GET['codigo_invitacion'] ?? '';

        // Mostrar el código de invitación en el formulario
        if (!empty($codigoInvitacion)) {
            echo '<div class="alert alert-info" role="alert">';
            echo '<p class="mb-0">Código de invitación: <strong>' . htmlspecialchars($codigoInvitacion) . '</strong></p>';
            echo '</div>';
        }
        ?>

        <form id="registroForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" required>
            
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" class="form-control" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" class="form-control" required>
            
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" class="form-control" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" class="form-control" required>
            
            <label for="codigo_referido">Código de referencia:</label>
            <input type="text" id="codigo_referido" name="codigo_referido" class="form-control" value="<?php echo htmlspecialchars($codigoInvitacion); ?>" readonly>
            
            <input type="submit" value="Registrarse" class="btn btn-danger mt-3">
        </form>
        
        <p class="mt-3">¿Ya tienes una cuenta? <a href="index.php">Iniciar sesión</a></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
