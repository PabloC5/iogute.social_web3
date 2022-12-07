<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Foto;
use \Framework\DW3BancoDeDados;

class TesteFoto extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('nome-teste','email-teste', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $arquivo = new Foto($this->usuarioId, 'foto.jpg', 'uma foto de teste', '2022-11-24', 'publico/img/6384187c9049d.jpg');
        $arquivo->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM fotos WHERE id = " . $arquivo->getId());
        $bdArquivo = $query->fetch();
        $this->verificar($bdArquivo['nome'] === $arquivo->getNome());
    }
}
