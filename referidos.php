<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuarioActual = $_SESSION['usuario'];

// Cargar datos de usuarios desde el archivo JSON
$usuarios = json_decode(file_get_contents('data/usuarios.json'), true);

// Obtener el código referido del usuario actual
$usuarioActualData = array_filter($usuarios, function ($usuario) use ($usuarioActual) {
    return $usuario['usuario'] === $usuarioActual;
});

$codigosReferidosIguales = [];

if (!empty($usuarioActualData)) {
    $codigoReferidoUsuarioActual = reset($usuarioActualData)['codigo_referido'];

    // Filtrar usuarios que tienen el mismo código referido
    $usuariosReferidos = array_filter($usuarios, function ($usuario) use ($codigoReferidoUsuarioActual, $usuarioActual) {
        return $usuario['codigo_referido'] === $codigoReferidoUsuarioActual && $usuario['usuario'] !== $usuarioActual;
    });

    $codigosReferidosIguales = array_column($usuariosReferidos, 'codigo_referido');
}

// Cargar datos de productos desde el archivo JSON
$productos = json_decode(file_get_contents('data/articulos.json'), true);
$enlacePersonalizado = "http://localhost:3000/registro.php/{$usuarioActual}";

// Verificar si hay referidos y usuarios referidos
$tieneReferidos = !empty($referidos);
$tieneUsuariosReferidos = !empty($usuariosReferidos);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
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

        <p>Bienvenido, <?php echo htmlspecialchars($usuarioActual); ?>.</p>
        
        <!-- Mostrar el enlace personalizado -->
        <p>Tu enlace de usuario es: <a href="<?php echo $enlacePersonalizado; ?>" target="_blank"><?php echo $enlacePersonalizado; ?></a></p>

        <!-- Mostrar referidos si los hay -->
        <?php if ($tieneReferidos) : ?>
            <h3 class="mt-4">Tus referidos:</h3>
            <ul class="list-group">
                <?php foreach ($referidos as $referido) : ?>
                    <li class="list-group-item">
                        <?php
                        echo "{$referido['nombre']} {$referido['apellido']} - ";
                        $enlaceReferido = "https://pruebas.softjalex.online/{$referido['usuario']}";
                        echo "<a href='{$enlaceReferido}' target='_blank'>{$enlaceReferido}</a>";
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No tienes referidos.</p>
        <?php endif; ?>

        <!-- Mostrar usuarios referidos si los hay -->
        <?php if ($tieneUsuariosReferidos) : ?>
            <h3 class="mt-4">Usuarios referidos:</h3>
            <ul class="list-group">
                <?php foreach ($usuariosReferidos as $referido) : ?>
                    <li class="list-group-item">
                        <?php
                        echo "{$referido['nombre']} {$referido['apellido']} - ";
                        $enlaceReferido = "https://www.worldglobal.word/{$referido['usuario']}";
                        echo "<a href='{$enlaceReferido}' target='_blank'>{$enlaceReferido}</a>";
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No tienes usuarios referidos.</p>
        <?php endif; ?>
    </div>

</body>
</html>