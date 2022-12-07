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
        $usuario = new Usuario('nome-teste','joao@teste.com', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $foto = new Foto($this->usuarioId, 'foto.jpg', 'uma foto de teste', '2022-11-24', 'publico/img/6384187c9049d.jpg');
        $foto->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM fotos WHERE id = " . $foto->getId());
        $bdFoto = $query->fetch();
        $this->verificar($bdFoto['hash_fotos'] === $foto->getfoto());
    }

    public function testeDestruir()
    {
        $foto = new Foto($this->usuarioId, 'foto.jpg', 'uma foto de teste', '2022-11-24', 'publico/img/6384187c9049d.jpg');
        $foto->salvar();
        Foto::destruir($foto->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM fotos');
        $bdFoto = $query->fetch();
        $this->verificar($bdFoto === false);
    }

    public function testeBuscarTodos()
    {
        (new Foto($this->usuarioId, 'foto.jpg', 'uma foto de teste', '2022-11-24', 'publico/img/6384187c9049d.jpg'))->salvar();
        (new Foto($this->usuarioId, 'foto2.jpg', 'uma foto de teste 2', '2022-11-24', 'publico/img/6384039d9cd2f.jpg'))->salvar();
        $fotos = Foto::buscarTodos();
        $this->verificar(count($fotos) == 2);
    }

    public function testeContarTodos()
    {
        (new Foto($this->usuarioId, 'foto.jpg', 'uma foto de teste', '2022-11-24', 'publico/img/6384187c9049d.jpg'))->salvar();
        (new Foto($this->usuarioId, 'foto2.jpg', 'uma foto de teste 2', '2022-11-24', 'publico/img/6384039d9cd2f.jpg'))->salvar();
        $total = Foto::contarTodos();
        $this->verificar($total == 2);
    }
}
