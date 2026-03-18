<?php
$senha = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';
if ($senha !== $confirmar) exit("As senhas não coincidem!");

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Caminho do JSON
$arquivo = __DIR__ . "/dados/usuarios.json";

// Lê os usuários existentes
$usuarios = [];
if(file_exists($arquivo)) {
    $usuarios = json_decode(file_get_contents($arquivo), true) ?? [];
}

// Atualiza o último usuário (ou você pode usar email para achar certo usuário)
$usuarios[count($usuarios)-1]["senha"] = $senhaHash;

// Salva de volta
file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT));

echo "Senha salva com segurança!";
?>