<!doctype html>
<html lang="pt-br">
    <head>
        <?php echo $this->include('template/include/header') ?>
        <link rel="stylesheet" href="resources/painel/css/painel.css">

        <title>Painel</title>
    </head>

    <body class="bg-light">

        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
            <a class="navbar-brand" href="/"><?php echo PROJECT_NAME; ?></a>
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Administrador</a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item"><a class="nav-link" href="/authentication/logout">Sair</a></li>
                </ul>
                <!--                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>-->
            </div>
        </nav>

        <div class="nav-scroller bg-white box-shadow">
            <nav class="nav nav-underline">
                <a class="nav-link active" href="#">Dashboard</a>
                <a class="nav-link" href="#">
                    Friends
                    <span class="badge badge-pill bg-light align-text-bottom">27</span>
                </a>
                <a class="nav-link" href="#">Explore</a>
                <a class="nav-link" href="#">Suggestions</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link" href="#">Link</a>
            </nav>
        </div>

        <main role="main" class="container">
            <div class="my-4">
                <h5 class="border-bottom border-gray pb-2 mb-0"><?php echo $title ?? ''; ?></h5>
            </div>

            <?php echo $this->renderSection('content') ?>

            <!--            <div class="my-3 p-3 bg-white rounded box-shadow">
                        </div>-->
        </main>

        <?php echo $this->include('template/include/javascript') ?>
    </body>
    <footer class="footer">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>
</html>
