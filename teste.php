<?php
$arquivo = __DIR__ . "/dados/usuarios.json";

// Cria pasta se não existir
if (!is_dir(dirname($arquivo))) mkdir(dirname($arquivo), 0777, true);

// Adiciona teste
$usuarios = [];
if(file_exists($arquivo)){
    $usuarios = json_decode(file_get_contents($arquivo), true) ?? [];
}

$usuarios[] = [
    "email" => $_POST['email'],
    "senha" => password_hash($_POST['senha'], PASSWORD_DEFAULT)
];
file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT));

echo "JSON atualizado! Veja em: " . $arquivo;
?>