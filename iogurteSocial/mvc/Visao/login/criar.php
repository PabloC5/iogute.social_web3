<div class="container-login">
    <div class="logo-img">
        <img src="<?= URL_IMG . 'logo.png' ?>" alt="logo">
    </div>
    <div class="formulario-login">
        <div class="titulo">
            Login
        </div>
        <form action="<?= URL_RAIZ . 'login' ?>" method="post">
            <div class="input-login <?= $this->getErroCss('login') ?>">
                <i class="fa fa-envelope"></i>
                <input id="email" name="email" type="text" placeholder="email"
                    value="<?= $this->getPost('email') ?>">
            </div>

            <div class="input-login <?= $this->getErroCss('login') ?>">
                <i class="fa fa-lock"></i>
                <input id="senha" name="senha" type="password" placeholder="senha">
            </div>
            <div class="form-group has-error text-center">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
            </div>
            <div class="input-login testeBotao">
                <button type="submit" class="botaoEntrar btn btn-primary">Entrar</button>
            </div>
            <div class="divider">ou</div>
            <div class="sigup">
                <a href="<?= URL_RAIZ . 'usuarios/criar' ?>">Criar uma conta agora!</a>
            </div>
        </form>
    </div>
</div>
