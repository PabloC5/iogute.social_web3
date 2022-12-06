<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;


class Usuario extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const BUSCAR_NOME = 'SELECT * FROM usuarios WHERE nome = ?';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    // const BUSCAR_POR_NOME = "SELECT * FROM usuarios WHERE nome LIKE ?";
    const INSERIR = 'INSERT INTO usuarios(email,senha, nome) VALUES (?, ?, ?)';
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $senhaPlana;
    private $foto;

    public function __construct(
        $nome,
        $email,
        $senha,
        $foto = null,
        $id = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->nome = $nome;
        $this->foto = $foto;
        $this->senhaPlana = $senha;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }

    protected function verificarErros()
    {
        if (strlen($this->email) < 3) {
            $this->setErroMensagem('email', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
        }
        if (DW3ImagemUpload::existeUpload($this->foto)
            && !DW3ImagemUpload::isValida($this->foto)) {
            $this->setErroMensagem('foto', 'Deve ser de no máximo 500 KB.');
        }
    }

    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->email, PDO::PARAM_STR);
        $comando->bindValue(2, $this->senha, PDO::PARAM_STR);
        $comando->bindValue(3, $this->nome, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['email'],
                '',
                $registro['nome'],
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }

    public static function buscarNome($nome)
    {
        $paramLike = "'%" . $nome . "%'";
        // var_dump($paramLike);
        // $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_NOME);
        // $comando->bindValue(1, $paramLike , PDO::PARAM_STR);
        $comando = DW3BancoDeDados::prepare("SELECT * FROM usuarios WHERE nome LIKE  $paramLike");
        $comando->execute();
        $objetos = [];
        $registros = $comando->fetchAll();
        // var_dump($registros);
        foreach ($registros as $registro) {
            if ($registro) {
                $objetos[] = new Usuario(
                    $registro['nome'],
                    $registro['email'],
                    '',
                    null,
                    $registro['id']
                );
                // $objeto->senha = $registro['senha'];
            }
        }
        return $objetos;
    }

    public static function buscarNomeSelect($nome)
    {
        // $comando = DW3BancoDeDados::prepare("SELECT * FROM usuarios WHERE nome = 'pablito'");
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME);
        $comando->bindValue(1, trim($nome), PDO::PARAM_STR);
        $comando->execute();
        var_dump($nome);
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        $objeto = new Usuario(
            $registro['nome'],
            $registro['email'],
            '',
            null,
            $registro['id']
        );
        return $objeto;
    }
}
