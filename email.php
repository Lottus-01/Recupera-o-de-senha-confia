<?php
$email = $_POST['email'] ?? '';
if (!$email) exit("Email não fornecido!");

// Caminho do JSON
$arquivo = __DIR__ . "/dados/usuarios.json";

// Cria a pasta se não existir
if (!is_dir(dirname($arquivo))) mkdir(dirname($arquivo), 0777, true);

// Lê o JSON existente
$usuarios = [];
if(file_exists($arquivo)) {
    $usuarios = json_decode(file_get_contents($arquivo), true) ?? [];
}

// Adiciona o e-mail (senha será adicionada depois)
$usuarios[] = ["email" => $email];

// Salva de volta
file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT));

// Redireciona para redefinir senha
header("Location: redefinir_senha.html");
exit;
?>