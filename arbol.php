<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuarioActual = $_SESSION['usuario'];

// Load user data from JSON file
$usuarios = json_decode(file_get_contents('data/usuarios.json'), true);

// Obtain the referral code of the current user
$usuarioActualData = array_filter($usuarios, function ($usuario) use ($usuarioActual) {
    return $usuario['usuario'] === $usuarioActual;
});

$codigosReferidosIguales = [];

if (!empty($usuarioActualData)) {
    $codigoReferidoUsuarioActual = reset($usuarioActualData)['codigo_referido'];

    // Filter users with the same referral code
    $usuariosReferidos = array_filter($usuarios, function ($usuario) use ($codigoReferidoUsuarioActual, $usuarioActual) {
        return $usuario['codigo_referido'] === $codigoReferidoUsuarioActual && $usuario['usuario'] !== $usuarioActual;
    });

    $codigosReferidosIguales = array_column($usuariosReferidos, 'codigo_referido');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árbol Binario de Referidos</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos adicionales -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .tree-node {
            border: 2px solid #3498db;
            padding: 8px;
            margin: 4px;
            display: inline-block;
            background-color: #ecf0f1;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .tree-connection {
            border-left: 2px solid #3498db;
            height: 20px;
            margin-left: 10px;
            margin-right: 10px;
            display: inline-block;
        }

        .referral-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 20px;
            margin-top: 20px;
        }

        .referral-list-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .referral-link {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
          
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
<body>
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

  <!-- Main Content -->
        <div class="main-content">
            <h1>Árbol Binario de Referidos</h1>

            <?php if (!empty($usuariosReferidos)) : ?>
                <h3 class="mt-4">Tus referidos:</h3>

                <div class="referral-list">
                    <?php foreach ($usuariosReferidos as $referido) : ?>
                        <div class="referral-list-item">
                            <?php
                            echo "{$referido['nombre']} {$referido['apellido']}<br>";
                            $enlaceReferido = "{$baseURL}/{$referido['usuario']}";
                            echo "<a class='referral-link' href='{$enlaceReferido}' target='_blank'>Ver perfil</a>";
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>No tienes referidos.</p>
            <?php endif; ?>
        </div>
    </div>
        <!-- Bootstrap JS y scripts adicionales (si es necesario) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts adicionales pueden ir aquí -->
</body>
</html>
