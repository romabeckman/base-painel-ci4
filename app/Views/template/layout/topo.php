<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="/"><?php echo PROJECT_NAME; ?></a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse align-items-start" id="top-menu">
        <ul class="navbar-nav mr-auto flex-wrap mr-3">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <?php echo menuAdministrator(); ?>
        </ul>
        <!--        <form class="form-inline mr-3">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>-->
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="settings-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo Authorization\Config\Auth::$user->name; ?>
                </a>
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