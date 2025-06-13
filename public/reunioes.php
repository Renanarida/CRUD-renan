<?php
require_once __DIR__ . '/../config/conexao.php';

$hoje = date('Y-m-d');
$result = $conn->query("SELECT * FROM reunioes ORDER BY data, hora");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../public/img/calendar.png">
    <link rel="stylesheet" href="./style/reunioes.css" />
    <title>Reuniões</title>

</head>

<body class="body-box">

    <header class="header-box">
        <nav id="nav-box" class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand ms-auto text-white" href="logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <div class="box-reuniao">
        <h2>Reuniões</h2>
        <!-- Botão para abrir o modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddReuniao">
            Cadastrar Reunião
        </button>

        <?php
        include './src/cadastrar_reuniao.php';
        include './src/editar_reuniao.php';
        include './src/adicionar_participante.php';

        ?>

        <div class="container mt-4">
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Pesquisar reuniões...">
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="cardsContainer">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col card-item">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['assunto']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?= htmlspecialchars($row['data']) ?> às <?= htmlspecialchars($row['hora']) ?>
                            </h6>
                            <p class="card-text"><strong>Local:</strong> <?= htmlspecialchars($row['local']) ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <button type="button" class="btn btn-warning btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditarReuniao" data-reuniao-id="<?= $row['id'] ?>"
                                data-reuniao-data="<?= htmlspecialchars($row['data']) ?>"
                                data-reuniao-hora="<?= htmlspecialchars($row['hora']) ?>"
                                data-reuniao-local="<?= htmlspecialchars($row['local']) ?>"
                                data-reuniao-assunto="<?= htmlspecialchars($row['assunto']) ?>">
                                Editar Reunião
                            </button>
                            <a class="btn btn-danger btn-primary" href="src/excluir_reuniao.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('Excluir reunião?')">Excluir</a>
                            <button class="btn btn-primary btn-info" data-bs-toggle="modal"
                                data-bs-target="#modalParticipantes" data-id="<?= $row['id'] ?>">
                                Participantes
                            </button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>


            <script src="./js/editar_reuniao.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>