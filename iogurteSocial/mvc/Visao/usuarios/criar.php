<div class="container-login">
    <div class="logo-img">
        <!-- <img src="/front-web3/src/img/logo.png" alt="logo"> -->
        <img src="<?= URL_IMG . 'logo.png' ?>" alt="logo">
    </div>
    <div class="formulario-login">
        <div class="titulo">
            Cadastro
        </div>
        <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post">
            <div class="input-login">
                <i class="fa fa-user"></i>
                <input id="nome" name="nome" type="text" placeholder="Nome">
            </div>
            <div class=" <?= $this->getErroCss('email') ?>">
        
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
            </div>

            <div class="input-login form-group <?= $this->getErroCss('email') ?>">
                <i class="fa fa-envelope"></i>
                <input class="form-control" id="email" name="email" type="text" placeholder="email">
            </div>
            <div class=" <?= $this->getErroCss('email') ?>">
        
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
            </div>

            <div class="input-login <?= $this->getErroCss('senha') ?>">
                <i class="fa fa-lock"></i>
                <input id="senha" name="senha" type="password" placeholder="senha">
            </div>
            <div class=" <?= $this->getErroCss('email') ?>">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
            </div>

            <div class="input-login testeBotao">
                <button type="submit" class="botaoEntrar btn btn-primary center-block">Cadastrar-se</button>
                <!-- <a class="botaoEntrar btn btn-primary" href="home.html">Criar</a> -->
            </div>

            <div class="divider">ou</div>
            <div class="sigin">
                <a href="<?= URL_RAIZ . 'login' ?>">Ja tenho uma conta!</a>
                <!-- <a href="login.html">Ja tenho uma conta!</a> -->
            </div>
        </form>
    </div>
</div>
