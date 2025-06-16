<?php  

// include_once './public/cadastrar.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Reuniões</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .features i {
            font-size: 3rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>

    <!-- Header / Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4">Bem-vindo ao Sistema de Reuniões</h1>
            <p class="lead">Organize, acompanhe e registre todas as suas reuniões de forma simples e eficiente.</p>
            <a href="#features" class="btn btn-light btn-lg mt-3">Saiba Mais</a>
        </div>
    </section>

    <!-- Features / Benefícios -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Principais Funcionalidades</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <i class="bi bi-calendar-check"></i>
                    <h4 class="mt-3">Agendamento Fácil</h4>
                    <p>Marque reuniões com poucos cliques e envie convites para os participantes.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="bi bi-people-fill"></i>
                    <h4 class="mt-3">Gestão de Participantes</h4>
                    <p>Adicione, edite e visualize quem estará presente em cada reunião.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="./public/img/simplicity.png" alt="" width="20" height="20">
                    <h4 class="mt-3">Acesso fácil</h4>
                    <p>Seu site de reuniões de fácil acesso.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h3>Pronto para começar?</h3>
            <p>Crie seu cadastro para criar reuniões de modo fácil e intuitivo:</p>
            <a href="/CRUD_RENAN/index.php" class="btn btn-primary btn-lg">Criar cadastro</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 bg-dark text-white text-center">
        <p>&copy; 2025 Sistema de Reuniões. Todos os direitos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html>
