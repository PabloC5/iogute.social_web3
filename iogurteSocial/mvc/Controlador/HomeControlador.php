<?php
namespace Controlador;

// use \Modelo\Reclamacao;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class HomeControlador extends Controlador
{
    public function index()
    {
        $this->verificarLogado();
        // $reclamacoes = Reclamacao::buscarNaoAtendidos();
        $this->visao('home/criar.php', [
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ], 'home.php');
    }

    public function criar()
    {
        $this->verificarLogado();
        $this->visao('home/criar.php', [
            'usuario' => $this->getUsuario()
        ], 'home.php');
    }

    // public function perfil()
    // {
    //     $this->verificarLogado();
    //     $this->visao('perfil/criar.php', [
    //         'usuario' => $this->getUsuario()
    //     ], 'perfil.php');
    //     // $this->visao('perfil/criar.php');
    // }
}
