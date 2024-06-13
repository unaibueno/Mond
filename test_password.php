<?php
// Contraseña en texto plano que quieres hashear y verificar
$contraseñaEnTextoPlano = 'HolaHola12';

// Genera un hash de la contraseña en texto plano
$hashDeContraseña = password_hash($contraseñaEnTextoPlano, PASSWORD_DEFAULT);

// Imprime el hash generado
echo "Contraseña en texto plano: " . $contraseñaEnTextoPlano . PHP_EOL;
echo "Hash de la contraseña: " . $hashDeContraseña . PHP_EOL;

// Simula el proceso de verificación de la contraseña
$contraseñaIngresada = 'HolaHola12'; // Esta sería la contraseña ingresada por el usuario en el formulario de login

// Verifica la contraseña ingresada contra el hash almacenado
$isPasswordCorrect = password_verify($contraseñaIngresada, $hashDeContraseña);

// Imprime el resultado de la verificación
echo "Resultado de password_verify: " . ($isPasswordCorrect ? 'true' : 'false') . PHP_EOL;
