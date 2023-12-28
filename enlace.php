<?php
// Función para generar un código aleatorio único
function generarCodigoAleatorio($longitud = 10) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}

// Generar un código aleatorio único
$codigoInvitacion = generarCodigoAleatorio();

// Construir el enlace de invitación con el código como parámetro
$enlaceInvitacion = "http:///registro.php?codigo_invitacion=$codigoInvitacion";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Enlace de Invitación</title>
</head>
<body>
    <h2>Generar Enlace de Invitación</h2>
    
    <p>Código de invitación generado: <strong><?php echo $codigoInvitacion; ?></strong></p>
    
    <p>Enlace de invitación:</p>
    <input type="text" value="<?php echo $enlaceInvitacion; ?>" readonly>
</body>
</html>
