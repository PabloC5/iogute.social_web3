<?php
namespace Controlador;

use \Modelo\Usuario;
use \FrameWork\DW3Sessao;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function armazenar()
    {
        // $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $usuario = new Usuario($_POST['nome'],$_POST['email'], $_POST['senha']);
        if ($usuario->isValido()) {
            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'usuarios/sucesso');

        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php');
        }
        // $usuario = new Usuario($_POST['email'], $_POST['senha'], $_POST['nome']);
        // $usuario->salvar();
        // $this->redirecionar(URL_RAIZ . 'usuarios/sucesso');
    }

    public function sucesso()
    {
        $this->visao('usuarios/sucesso.php');
    }
}
