<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><?php echo PROJECT_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#top-menu" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="top-menu">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <?php echo menuAdministrator(); ?>
            </ul>
            <ul class="navbar-nav d-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="settings-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo Authorization\Config\Auth::$user->name ?? ''; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settings-dropdown">
                        <a class="dropdown-item" href="/profile/password">Alterar senha</a>
                        <a class="dropdown-item" href="/authentication/logout">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>