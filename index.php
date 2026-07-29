<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Biblioteca</title>

    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/estilo.css" rel="stylesheet">
</head>
<body>

    <!-- Menu superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">📚 Biblioteca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-lg-2" href="login.php">Entrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Seção hero -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-5">Sistema de Controle de Biblioteca</h1>
            <p class="lead mt-3">
                Gerencie o acervo de livros, os clientes cadastrados e os empréstimos
                da sua biblioteca em um só lugar, de forma simples e organizada.
            </p>
            <a href="login.php" class="btn btn-primary btn-lg mt-3">Acessar o sistema</a>
        </div>
    </section>

    <!-- Funcionalidades -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Funcionalidades</h2>
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card card-funcionalidade shadow-sm">
                        <img src="https://picsum.photos/seed/livros/400/300" class="card-img-top" alt="Cadastro de livros">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Livros</h5>
                            <p class="card-text">
                                Registre os livros do acervo com título, autor e quantidade
                                de exemplares disponíveis para empréstimo.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-funcionalidade shadow-sm">
                        <img src="https://picsum.photos/seed/clientes/400/300" class="card-img-top" alt="Cadastro de clientes">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Clientes</h5>
                            <p class="card-text">
                                Mantenha os dados dos clientes da biblioteca sempre
                                atualizados para agilizar os empréstimos.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-funcionalidade shadow-sm">
                        <img src="https://picsum.photos/seed/emprestimos/400/300" class="card-img-top" alt="Controle de empréstimos">
                        <div class="card-body">
                            <h5 class="card-title">Controle de Empréstimos</h5>
                            <p class="card-text">
                                Registre empréstimos e devoluções, acompanhando prazos
                                e a disponibilidade de cada livro.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Sistema de Controle de Biblioteca - Projeto Didático</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
