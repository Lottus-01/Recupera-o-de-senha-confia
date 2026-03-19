<?php
if (!is_dir(__DIR__.'/dados')) mkdir(__DIR__.'/dados', 0777, true);

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
if (!$email || !$senha) exit("Email ou senha não fornecidos!");

// Caminho do JSON
$arquivo = __DIR__ . "/dados/usuarios.json";

// Lê o JSON existente
$usuarios = [];
if(file_exists($arquivo)) {
    $usuarios = json_decode(file_get_contents($arquivo), true) ?? [];
}

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se o usuário já existe
$encontrado = false;
foreach ($usuarios as &$u) {
    if ($u['email'] === $email) {
        $u['senha'] = $senhaHash; // atualiza a senha
        $encontrado = true;
        break;
    }
}
unset($u);

// Se não encontrou, adiciona novo usuário
if (!$encontrado) {
    $usuarios[] = [
        'email' => $email,
        'senha' => $senhaHash
    ];
}

// Salva no JSON
file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT));

echo "Usuário salvo com sucesso!";
?>