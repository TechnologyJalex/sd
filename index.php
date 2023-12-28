
<?php
session_start();

// Verificar si existe una cookie para el usuario
if (isset($_COOKIE['recordar_usuario'])) {
    $usuarioRecordado = $_COOKIE['recordar_usuario'];
} else {
    $usuarioRecordado = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Leer el archivo JSON de usuarios
    $usuarios = file_get_contents('data/usuarios.json');
    $usuarios = json_decode($usuarios, true);

    // Verificar credenciales
    $usuarioEncontrado = false;
    foreach ($usuarios as $usuarioRegistrado) {
        if ($usuarioRegistrado['usuario'] === $usuario && $usuarioRegistrado['contrasena'] === $contrasena) {
            $usuarioEncontrado = true;
            break;
        }
    }

    if ($usuarioEncontrado) {
        // Iniciar sesión y redirigir al dashboard
        $_SESSION['usuario'] = $usuario;

        // Recordar usuario utilizando una cookie
        if (isset($_POST['recordar']) && $_POST['recordar'] === 'recordar') {
            setcookie('recordar_usuario', $usuario, time() + (30 * 24 * 60 * 60), '/');
        }

        header("Location: dashboard.php");
        exit();
    } else {
        $mensajeError = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Agrega estilos adicionales si es necesario */
        label.form-label {
            color: white;
        }
        label.form-check-label{
            color:white;
        }
        .navbar-logo {
            width: 150px;
            height: auto;
        }
        .btn-primary {
            background-color: #dc3545; /* Bootstrap red color */
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #c82333; /* Darker red on hover */
            border-color: #c82333;
        }
        .btn-register {
            background-color: #dc3545; /* Bootstrap red color */
            border-color: #dc3545;
            color: white; /* Text color is white */
        }
        .btn-register:hover {
            background-color: #c82333; /* Darker red on hover */
            border-color: #c82333;
        }
        .container {
            max-width: 600px; /* Adjust the maximum width as needed */
        }
        #loginForm {
            margin-top: 20px;
        }
        #olvidasteLink {
            color: white !important;
        }
    </style>
</head>
  <!-- Bootstrap Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
             <!-- Logo -->
             <a class="navbar-brand" href="#">
                <img src="/documentos/img/logo.png" alt="World Global" class="navbar-logo">
            </a>
           
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
<body class="bg-dark">
    <div class="container py-4">
        <h2>Iniciar sesión</h2>
        
        <?php if (isset($mensajeError)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensajeError; ?>
            </div>
        <?php } ?>
        
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo htmlspecialchars($usuarioRecordado); ?>" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <div class="input-group">
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                    <button class="btn btn-outline-secondary" type="button" id="verContrasena">
                        <i class="fas fa-eye"></i> <!-- Font Awesome icon for eye -->
                    </button>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="recordar" name="recordar" value="recordar">
                <label class="form-check-label" for="recordar">Recordar usuario</label>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Entrar</button>
            <a href="registro.php" class="btn btn-register"><i class="fas fa-user-plus"></i> Registrarse</a>
        </form>
        
    
        <p class="mt-3 text-center">
                <a href="#" id="olvidasteLink">¿Olvidaste tu contraseña?</a>
        </p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <!-- Enlaces a los archivos JS de Bootstrap y JavaScript para mostrar/ocultar la contraseña -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('verContrasena').addEventListener('click', function () {
            var contrasenaInput = document.getElementById('contrasena');
            if (contrasenaInput.type === 'password') {
                contrasenaInput.type = 'text';
            } else {
                contrasenaInput.type = 'password';
            }
        });
    </script>
</body>
</html>
