<?php
if (!is_dir(__DIR__.'/dados')) mkdir(__DIR__.'/dados', 0777, true);

$email = $_POST['email'] ?? '';
if (!$email) exit("Email não fornecido!");

// Caminho do JSON
$arquivo = __DIR__ . "/dados/usuarios.json";

// Lê o JSON existente
$usuarios = [];
if(file_exists($arquivo)) {
    $usuarios = json_decode(file_get_contents($arquivo), true) ?? [];
}

// Verifica se o usuário já existe
$encontrado = false;
foreach ($usuarios as $u) {
    if ($u['email'] === $email) {
        $encontrado = true;
        break;
    }
}

// Se não existe, adiciona usuário
if (!$encontrado) {
    $usuarios[] = ['email' => $email, 'senha' => ''];
    file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT));
}

// Redireciona (ou só mostra mensagem)
echo "Email salvo com sucesso!";
?>