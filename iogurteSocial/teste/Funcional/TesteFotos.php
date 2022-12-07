<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Foto;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteFotos extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'home');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeListagem()
    {
        $this->logar();
        (new Foto($this->usuario->getId(), 'foto.jpg', 'uma foto de teste', '2022-11-24', 'publico/img/6384187c9049d.jpg'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'home');
        
        $this->verificarContem($resposta, 'foto.jpg');
        $this->verificarContem($resposta, 'uma foto de teste');
        $this->verificarContem($resposta, '24-11-2022');
    }

    public function testeArmazenarDeslogado()
    {
        $resposta = $this->post(URL_RAIZ . 'home', [
            'titulo' => 'foto.jpg'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }
}
