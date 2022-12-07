<header>
        <nav>
            <a class="nomeUser" href="<?= URL_RAIZ . 'home' ?>">
                <i class="fa fa-user"></i>
                <?= $buscaUsuarios->getNome() ?>
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
              <li class="testeListe">
                <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="inline">
                    <input type="hidden" name="_metodo" value="DELETE">
                    <a class="" onclick="event.preventDefault(); this.parentNode.submit()">Sair</a>
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
                <?php if ($arquivo->getUsuarioId() == $buscaUsuarios->getId()) : ?>
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
                        <!-- <button type="button" class="btn btn-danger">Excluir</button> -->
                        <!-- <button type="submit" class="btn btn-xs btn-danger" title="Deletar">
                          Excluir
                        </button> -->
                        <form action="<?= URL_RAIZ . 'perfil/' . $arquivo->getId() ?>" method="post" class="d-inline ">
                          <input type="hidden" name="_metodo" value="DELETE">
                          <button class="btn btn-outline-danger">
                              Excluir
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal excluir -->
                  <div class="col-6 offset-3">
                      <div class="card-deck">
                          <div class="card mt-3 mb-3">
                              <img class="card-img-top" src="<?= $arquivo->getfoto() ?>" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title"><?= $arquivo->getTitulo() ?></h5>
                                <p class="card-text"><?= $arquivo->getDescricao() ?></p>
                                <p class="card-text"><small class="text-muted"><?= $arquivo->getDataFormatada() ?></small></p>
                                <hr>
                                <p>
                              </div>
                          </div>
                      </div>
                  </div> 
                <?php endif ?>
              <?php endforeach ?> 
              <div class="col-6 offset-3 mb-2">
                <?php if ($pagina > 1) : ?>
                    <a href="<?= URL_RAIZ . 'perfil?p=' . ($pagina-1) ?>" class="btn btn-primary">Página anterior</a>
                <?php endif ?>
                <?php if ($pagina < $ultimaPagina) : ?>
                    <a href="<?= URL_RAIZ . 'perfil?p=' . ($pagina+1) ?>" class="btn btn-primary">Próxima página</a>
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
    <!-- <script src="js/navbar.js"></script> -->