<header>
    <nav>
        <a class="logo" href="">
            <img src="<?= URL_IMG . 'logo-branco.png' ?>" alt="logo">
        </a>
            <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-list">
            <li class="testeListe">
                <a href="<?= URL_RAIZ . 'home' ?>">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropDPerfil nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Perfil
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
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
                <!-- fazer os ajustes -->
                <div class="row px-0">
                      <?php if ($buscaUsuarios == null) : ?>
                        <div class="col-12">
                          <form action="<?= URL_RAIZ . 'home' ?>" method="get">
                            <div class="form-group">
                              <input type="text" class="form formPesquisa" name="buscando" id="formGroupExampleInput" placeholder="Pesquisar">
                              <input type="submit" name="acao" value="Pesquisar" class="btn btn-primary">
                              <!-- <button type="submit" name="acao" id="botaoPesquisa" class="btn btn-outline-light btn-sm">Pesquisar</button> -->
                            </div>
                          </form>
                        </div>
                      <?php endif ?>  
                    <!-- <div class="col-6"> -->
                    <?php if ($buscaUsuarios != null) : ?>
                      <form action="<?= URL_RAIZ . 'perfil/usuarios' ?>" method="get">
                      <div class="form-group row">
                        <div class="col-8">
                          <select name="selectNomes" class="form-select" aria-label="Default select example">
                            <?php foreach ($buscaUsuarios as $buscaUsuario) : ?>
                              <option value=" <?= $buscaUsuario->getNome() ?>"><?= $buscaUsuario->getNome() ?></option>                                                    
                            <?php endforeach ?> 
                          </select>
                        </div>
                        <div class="col-4">
                          <input type="submit" name="acao" value="acessar" class="btn btn-primary">
                        </div>
                        
                      </div>
                    </form>
                      <?php endif ?>  
                  </div>
            </li>
            </ul>
    </nav>
</header>
<main>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Postar fotos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="<?= URL_RAIZ . 'home' ?>" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Escolha uma imagem para postar</label>
                      <input class="form-control" name="file" type="file" id="formFile">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Titulo da sua foto:</label>
                    <input type="text" class="form-control" name="titulo" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Descrição:</label>
                    <textarea class="form-control" name="descricao" id="message-text"></textarea>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" name="acao" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    <!-- modal -->
    <div class="container">
    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-warning alert-dismissible pe-2 fade show bg-dark text-light border-light" role="alert">
            <strong><?= $mensagemFlash ?></strong>
            <button type="button" class="bg-transparent border-0 float-end d-inline " data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times text-light"></i></button>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-6 offset-3">
        <?php foreach ($arquivos as $arquivo) : ?>
            <!-- teste card -->
            <div class="card mb-3 mt-3">
                <img class="card-img-top" src="<?= $arquivo->getfoto() ?>" alt="Card image cap">
                <div class="card-body">
                        <h5 class="card-title"><?= $arquivo->getTitulo() ?></h5>
                        <p class="card-text"><?= $arquivo->getDescricao() ?></p>
                        <p class="card-text"><small class="text-muted"><?= $arquivo->getDataFormatada() ?></small></p>
                </div>
            </div>
        <?php endforeach ?>
            <!-- teste card -->
        </div>  
        <div class="col-6 offset-3 mb-2">
                <?php if ($pagina > 1) : ?>
                    <a href="<?= URL_RAIZ . 'home?p=' . ($pagina-1) ?>" class="btn btn-primary">Página anterior</a>
                <?php endif ?>
                <?php if ($pagina < $ultimaPagina) : ?>
                    <a href="<?= URL_RAIZ . 'home?p=' . ($pagina+1) ?>" class="btn btn-primary">Próxima página</a>
                <?php endif ?>
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