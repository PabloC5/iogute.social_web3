    <header>
        <nav>
            <a class="nomeUser" href="perfil.html">
                <i class="fa fa-user"></i>
                <!-- Pablo Correia -->
                <?= $this->nomeUsuario->getNome() ?>
                <!-- teste nome logado -->
                
                <!-- teste nome logado -->
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
                <a href="<?= URL_RAIZ . 'home' ?>">Home</a>
              </li>
                <li class="nav-item dropdown">
                  <a class="dropDPerfil nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Perfil
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                    <li>
                      <!-- <a class="dropdown-item" href="perfil.html">Ver meu perfil</a> -->
                      <a href="<?= URL_RAIZ . '/home/perfil' ?>">Ver meu perfil</a>
                    </li>
                    <li><a class="dropdown-item" href="login.html">Sair</a></li>
                  </ul>
                </li>
                <!-- <li class="testeListe"><a href="perfil.html">Perfil</a></li> -->
                <button type="button" class="btn btn-outline-light upImageBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fa fa-image"></i>
                  Postar
                </button>
                <li>
                  <form>
                    <div class="form-group">
                      <input type="text" class="form formPesquisa" id="formGroupExampleInput" placeholder="Pesquisar">
                      <button type="submit" id="botaoPesquisa" class="btn btn-outline-light btn-sm">Pesquisar</button>
                    </div>
                  </form>
                </li>
              </ul>
        </nav>
    </header>
    <main>
      <!-- testando algumas coisas -->
    <div>
    
    </div>
      <!-- testando algumas coisas -->
      <?php $this->incluirVisao('util/formErro.php', ['campo' => 'perfil']) ?>
      
        <!-- modal excluir -->
        <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ecluir Postagem?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir essa postagem? Sua fota sera excluída permanentemente
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger">Excluir</button>
                </div>
              </div>
            </div>
          </div>
        <!-- modal excluir -->
      
        <!-- modal importar imagem-->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Postar fotos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="<?= URL_RAIZ . 'perfil' ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Escolha uma imagem para postar</label>
                    <input class="form-control" name="file" type="file" id="formFile">

                </div>
                <div class="modal-footer">
                  <input type="submit" name="acao" value="Save" class="btn btn-primary">
                  <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <!-- modal importar imagem-->
      <div class="container">
      <?php if ($mensagemFlash) : ?>
        <div class="alert alert-warning alert-dismissible pe-2 fade show bg-dark text-light border-light" role="alert">
            <strong><?= $mensagemFlash ?></strong>
            <button type="button" class="bg-transparent border-0 float-end d-inline " data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times text-light"></i></button>
        </div>
      <?php endif ?>
        <!-- começa -->
          <div class="row">
              <?php foreach ($arquivos as $arquivo) : ?>
                <?php if ($arquivo->getUsuarioId() == $usuario) : ?>

                  <div class="col-6 offset-3">
                      <div class="card-deck">
                          <div class="card mt-3 mb-3">
                              <img class="card-img-top " src="<?= $arquivo->getfoto() ?>" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                <hr>
                                <p>
                                <button  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                  <i class="fa fa-trash"></i>
                                  Excluir
                                </button>
                              </div>
                          </div>
                      </div>
                  </div> 
                  <?php endif ?>
                <?php endforeach ?> 
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
    <!-- <script src="js/navbar.js"></script> -->