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

// Read FAQ data from the JSON file
$faqData = json_decode(file_get_contents('faq.json'), true);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Descargar PDF - Word Global</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos adicionales -->
    <style>
         body {
        color: #fff; /* Set text color to white for the entire body */
    }
        /* Estilos adicionales pueden ir aquí */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            padding-top: 3rem;
            background-color: #343a40;
            color: #fff;
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
        .product-card {
            margin-bottom: 20px;
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
    
    <div class="mt-auto text-center"> <!-- Use the "mt-auto" class to push content to the bottom -->
    <hr class="divider"> <!-- Add a horizontal line as a visual separator -->

    <div class="mt-3">
        <img src="documentos/img/perfil.png" alt="User Photo" class="img-fluid rounded-circle mx-auto d-block mb-3" style="width: 80px; height: 80px;">
        <p class="text-center mb-0">
            <a href="perfil.php" class="text-white text-decoration-none"><?php echo htmlspecialchars($usuarioActual); ?></a>
        </p>    <div class="d-flex justify-content-center">
    <a href="ajustes.php" class="btn btn-success btn-block mt-3 mr-2">Ajustes</a>
    <a href="logout.php" class="btn btn-danger btn-block mt-3">Cerrar sesión</a>
</div>

    </div>
</div>

   
</div>
<div class="main-content">
    <h1>Descargar Documento PDF</h1>
        
    <p>Haz clic en el siguiente enlace para descargar el documento PDF:</p>
    
    <p><a href="documentos/1.pdf" download>Descargar PDF</a></p>
    
    <p>Este enlace proporciona directamente el archivo PDF para su descarga.</p>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts adicionales pueden ir aquí -->
</body>
</html>
