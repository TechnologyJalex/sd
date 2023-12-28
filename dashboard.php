<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuarioActual = $_SESSION['usuario'];

// Load user data from JSON file
$usuarios = json_decode(file_get_contents('data/usuarios.json'), true);

// Filter referidos for the current user
$referidos = array_filter($usuarios, function ($usuario) use ($usuarioActual) {
    return $usuario['codigo_referido'] === $usuarioActual;
});

// Load product data from JSON file
$productos = json_decode(file_get_contents('data/articulos.json'), true);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ez0oCrFNt0sN6pUG6AZMfhY1tGqOx1fRN+wl4z5eVOFl5aCWbYAAZaR8z3KpPaa" crossorigin="anonymous">
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
        .main-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    color: #fff;
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
        </p>
    <div class="d-flex justify-content-center">
    <a href="ajustes.php" class="btn btn-success btn-block mt-3 mr-2">Ajustes</a>
    <a href="logout.php" class="btn btn-danger btn-block mt-3">Cerrar sesión</a>
</div>


    </div>
</div>

   
</div> 

    <div class="main-content">
        <h2 class="mb-4">Bienvenido al panel de control</h2>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34 color-text: white;);" aria-label="breadcrumb">
            <ol class="breadcrumb" style="color: white;">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">BackOffice</li>
            </ol>
        </nav>
        <p>Bienvenido, <?php echo htmlspecialchars($usuarioActual); ?>.</p>
        <?php include('informacion.php'); ?>
        
    </div>


    </div>

    <!-- Bootstrap JS y scripts adicionales (si es necesario) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts adicionales pueden ir aquí -->
</body>
</html>
