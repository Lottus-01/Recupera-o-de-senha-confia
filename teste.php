<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Testa se veio do POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Acesso inválido. Use o formulário.");
}

$senha = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if ($senha !== $confirmar) {
    exit("As senhas não coincidem!");
}

if (strlen($senha) < 6) {
    exit("A senha deve ter pelo menos 6 caracteres.");
}

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Detecta Área de Trabalho automaticamente
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $desktop = getenv('USERPROFILE') . "/Desktop";
} else {
    $desktop = getenv('HOME') . "/Desktop";
}

if (!$desktop) {
    exit("Não foi possível detectar a Área de Trabalho.");
}

$pasta = $desktop . "/meus_dados";

// Cria a pasta se não existir
if (!is_dir($pasta)) {
    if (!mkdir($pasta, 0777, true)) {
        exit("Falha ao criar a pasta: $pasta. Verifique permissões.");
    } else {
        echo "Pasta criada com sucesso: $pasta<br>";
    }
} else {
    echo "Pasta já existe: $pasta<br>";
}

// Arquivo final
$caminho = $pasta . "/dados.txt";

// Tenta salvar
if (file_put_contents($caminho, "Hash: $senhaHash\n-------------------\n", FILE_APPEND) === false) {
    exit("Erro ao salvar o arquivo: $caminho. Verifique permissões.");
}

echo "Senha salva com sucesso em: $caminho";
?>