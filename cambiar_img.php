<?php
// Datos del usuario
$usuario = [
    'nombre' => 'Usuario Ejemplo',
    'email' => 'usuario@example.com',
    // Otros datos del usuario...
];

// Función para obtener una imagen aleatoria de Lorem Picsum
function getRandomImageURL($width, $height) {
    $randomNumber = rand(1, 1000); // Generar un número aleatorio para la imagen
    return "https://picsum.photos{$width}{$height}?random={$randomNumber}";
}

// Tamaño deseado para la imagen aleatoria
$imageWidth = 200;
$imageHeight = 200;

// Obtener la URL de la imagen aleatoria
$imageURL = getRandomImageURL($imageWidth, $imageHeight);

// Agregar la URL de la imagen al array del usuario
$usuario['imagen_perfil'] = $imageURL;

// Convertir el array a formato JSON
$usuarioJSON = json_encode($usuario);

// Guardar los datos del usuario en un archivo JSON
file_put_contents('datos_usuario.json', $usuarioJSON);
function generateRandomCode($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, $max)];
    }
    return $code;
}

// Función para generar el enlace con el dominio y el código
function generateLink($domain) {
    $code = generateRandomCode(); // Generar un código aleatorio
    return "https://{$linkGenerado}/{$code}";
}

// Dominio personalizado
$miDominio = 'miweb.com';

// Generar el enlace con el dominio personalizado y el código aleatorio
$linkGenerado = generateLink($miDominio);

// Mostrar el enlace generado
echo "Enlace generado: <a href='{$linkGenerado}'>{$linkGenerado}</a>";

echo "imagen: <img src='{$usuario['imagen_perfil']}' alt='Imagen de perfil'>";
?>

    