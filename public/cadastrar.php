<?php
session_start();
require_once __DIR__ . '/../config/conexao.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $senha_confirm = $_POST['senha_confirm'] ?? '';

            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $senha);
            if ($stmt->execute()) {
                $_SESSION['id'] = $stmt->id;
                $_SESSION['nome'] = $nome;     
                header("Location: reunioes.php");
                exit;
            } else {
                $erro = "Erro ao cadastrar usuário.";
            }
        }
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../public/img/calendar.png">
    <link rel="stylesheet" href="./style/cadastrar.css" />
</head>
<body id="body-box" class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 350px;">
        <h3 class="mb-3">Cadastro</h3>

        <?php if ($erro): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="post" action="" novalidate>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" required class="form-control" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" required class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" id="senha" name="senha" required class="form-control" />
            </div>
            <div class="mb-3">
                <label for="senha_confirm" class="form-label">Confirme a Senha</label>
                <input type="password" id="senha_confirm" name="senha_confirm" required class="form-control" />
            </div>

            <button type="submit" class="btn btn-success w-100">Cadastrar</button>
        </form>

        <div class="mt-3 text-center">
            Já tem conta? <a href="login.php">Faça login</a>
        </div>
    </div>

    <script src="./js/login.js"></script>
    
</body>
</html>