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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="admin-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuração</a>
                <div class="dropdown-menu" aria-labelledby="admin-dropdown">
                    <a class="dropdown-item" href="/administrator/user">Usuários</a>
                    <a class="dropdown-item" href="/administrator/group">Grupos</a>
                    <a class="dropdown-item" href="/administrator/configuration">Configurações</a>
                </div>
            </li>
        </ul>
<!--        <form class="form-inline mr-3">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>-->
        <ul class="navbar-nav ml-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="settings-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settings-dropdown">
                    <a class="dropdown-item" href="/profile/password">Alterar senha</a>
                    <a class="dropdown-item" href="/authentication/logout">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--<div class="nav-scroller bg-white box-shadow">
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
</div>-->