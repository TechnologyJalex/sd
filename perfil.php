<?php
// Start the session
session_start();

// Check if the user is not logged in, then redirect to the index page
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Get the current user from the session
$usuarioActual = $_SESSION['usuario'];

// Read user data from the JSON file
$usuarios = json_decode(file_get_contents('usuarios.json'), true);

// Initialize an array to store user data
$datosUsuario = [];

// Find and retrieve the data of the current user
foreach ($usuarios as $usuario) {
    if ($usuario['usuario'] === $usuarioActual) {
        $datosUsuario = $usuario;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil World Global</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional styles -->
    <style>
        body {
            color: #fff;
            
        }
       
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            padding-top: 3rem;
            background-color: #343a40;
            color: #fff;
            overflow-y: auto; /* Add scroll to the sidebar if content overflows */
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .sidebar-link {
            color: #fff;
            text-decoration: none;
        }
        .sidebar-link:hover {
            color: #f8f9fa;
        }
        .user-details {
            margin-top: auto;
            text-align: center;
            padding: 10px;
            background-color: #343a40; /* Match the sidebar background color */
        }
        .user-details img {
            width: 80px;
            height: 80px;
        }
        .btn-change-password {
            margin-top: 10px;
        }
    
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .main-content {
      
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            color: #007bff;
        }

        h3 {
            color: #fff;
        }

        .list-group-item {
            background-color: #f8f9fa;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
        }

        .btn-change-password {
            margin-top: 5px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
  
    </style>
</head>
<body class="bg-dark">
    <div class="sidebar">
        <h2 class="text-center mb-4">Dashboard</h2>

        <ul class="nav flex-column">
            <!-- Sidebar links -->
            <li class="nav-item mb-3">
                <a href="dashboard.php" class="nav-link sidebar-link">Inicio</a>
            </li>
            <li class="nav-item mb-3">
                <a href="referidos.php" class="nav-link sidebar-link">Ver mis referidos</a>
            </li>
            <li class="nav-item">
                <a href="perfil.php" class="nav-link sidebar-link">Ver mi perfil</a>
            </li>
            <li class="nav-item">
                <a href="faq.php" class="nav-link sidebar-link">FAQ</a>
            </li>
            <li class="nav-item">
                <a href="pdf.php" class="nav-link sidebar-link">Documento</a>
            </li>
            <li class="nav-item">
                <a href="arbol.php" class="nav-link sidebar-link">Árbol</a>
            </li>
        </ul>

        <!-- User details section -->
        <div class="user-details">
            <img src="documentos/img/perfil.png" alt="User Photo" class="img-fluid rounded-circle mb-3">
            <p class="text-white mb-0">
                <a href="perfil.php" class="text-decoration-none"><?php echo htmlspecialchars($usuarioActual); ?></a>
            </p>    <div class="d-flex justify-content-center">
    <a href="ajustes.php" class="btn btn-success btn-block mt-3 mr-2">Ajustes</a>
    <a href="logout.php" class="btn btn-danger btn-block mt-3">Cerrar sesión</a>
</div>

        </div>
    </div>

    <div class="main-content">
      

        <h3>Datos del usuario:</h3>

        <ul class="list-group">
            <?php foreach ($datosUsuario as $campo => $valor) { ?>
                <?php if ($campo === 'contrasena') { ?>
                    <li class="list-group-item">
                        <strong><?php echo ucfirst($campo); ?>:</strong> <?php echo str_repeat("*", strlen($valor)); ?>
                        <button class="btn btn-secondary btn-sm btn-change-password" onclick="location.href='cambiar_contrasena.php'">Cambiar contraseña</button>
                    </li>
                <?php } else { ?>
                    <li class="list-group-item">
                        <strong><?php echo ucfirst($campo); ?>:</strong> <?php echo $valor; ?>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

