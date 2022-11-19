<header>
    <nav>
        <a class="logo" href="home.html">
            <img src="<?= URL_IMG . 'logo-branco.png' ?>" alt="logo">
            <!-- <img src="img/logo-branco.png" alt="logo"> -->
        </a>
            <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-list">
            <li class="testeListe">
                <!-- <a href="home.html">Home</a> -->
                <a href="<?= URL_RAIZ . 'home/criar' ?>">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropDPerfil nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Perfil
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                <!-- <li><a class="dropdown-item" href="perfil.html">Ver meu perfil</a></li> -->
                <li>
                    <a class="dropdown-item" href="<?= URL_RAIZ . 'perfil' ?>">Ver meu perfil</a>
                </li>
                <!-- teste -->
                <li>
                    <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="inline">
                        <input type="hidden" name="_metodo" value="DELETE">
                        <a class="dropdown-item" onclick="event.preventDefault(); this.parentNode.submit()">Sair</a>
                    </form>
                </li>
                <!-- teste -->
                </ul>
            </li>
            <button type="button" class="btn btn-outline-light upImageBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-image"></i>
                Postar
            </button>
            <li>
                <form>
                <div class="form-group">
                    <input type="text" class="form formPesquisa" id="formGroupExampleInput" placeholder="Pesquisar">
                    <!-- <select class="form-select" aria-label="Default select example">
                        <option selected>Users</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select> -->
                    <button type="submit" id="botaoPesquisa" class="btn btn-outline-light btn-sm">Pesquisar</button>
                </div>
                </form>
            </li>
            </ul>
    </nav>
</header>
<main>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Postar fotos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
            <label for="formFile" class="form-label">Escolha uma imagem para postar</label>
            <input class="form-control" type="file" id="formFile">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    <!-- modal -->
    <div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <!-- teste card -->
            <div class="card mb-3 mt-3">
                <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                <img class="card-img-top" src="<?= URL_IMG . 'foto2.jpg' ?>" alt="Card image cap">
                <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="<?= URL_IMG . 'foto3.jpg' ?>" alt="Card image cap">
                <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card mt-3 mb-3">
                <img class="card-img-top" src="<?= URL_IMG . 'foto1.jpg' ?>" alt="Card image cap">
                <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <!-- teste card -->
        </div>  
    </div>
    </div>
</main>
<footer class="navbar">
    <div class="testeRoda">
        <p>
        IOGURTE.SOCIAL a sua rede social
        </p>

        <p>
        © 2022 - By Pablo Correia
        </p>
    </div>
</footer>