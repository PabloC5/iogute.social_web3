<?php
namespace Modelo;
use \PDO;
use DateTime;
use \Framework\DW3BancoDeDados;
class Foto extends Modelo
{
    const BUSCAR_TODOS = 'SELECT u.id as u_id, u.email, f.data_up,f.titulo , f.descricao , f.id as f_id ,u.senha, u.nome as u_nome, f.hash_fotos FROM fotos f JOIN usuarios u on (f.usuario_id = u.id) ORDER BY f.id LIMIT ? OFFSET ?';

    const BUSCAR_ID = 'SELECT * FROM fotos WHERE id = ? LIMIT 1';
    const DELETAR = 'DELETE FROM arquivos WHERE id = ?';
    const ATUALIZAR_DESCRICAO = 'UPDATE arquivos SET descricao = ? WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM fotos';
    const INSERIR = 'INSERT INTO fotos(usuario_id, titulo, descricao, data_up, hash_fotos) VALUES (?, ?, ?, ?, ?)';

    private $id;
    private $usuarioId;
    private $titulo;
    private $descricao;
    private $pathFoto;
    private $data_up;
    private $usuario;
    public function __construct(
        $usuarioId,
        $titulo,
        $descricao,
        $data_up,
        $pathFoto,
        $usuario = null,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->pathFoto = $pathFoto;
        $this->data_up = $data_up;
        $this->usuario = $usuario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getfoto()
    {
        return $this->pathFoto;
    }

    public function getDataFormatada($formato='d-m-Y H:i:s')
    {
        $dataFormatada = new DateTime($this->data_up);
        return $dataFormatada->format($formato);
    }
    
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->titulo, PDO::PARAM_STR);
        $comando->bindValue(3, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(4, $this->data_up, PDO::PARAM_STR);
        $comando->bindValue(5, $this->pathFoto, PDO::PARAM_STR);
        // var_dump($comando);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
        // echo "arquivo enviado com sucesso";
    }
    
    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Foto(
                $registro['u_id'],
                $registro['titulo'],
                $registro['descricao'],
                $registro['data_up'],
                $registro['hash_fotos'],
                $usuario,
                $registro['f_id'],
                // $registro['usuario_id'],
                // $registro['nome'],
                // $registro['descricao'],
                // $registro['hash_fotos'],
                // $registro['data_up'],
                // null,
                // $registro['id']
            );
            
        }
        return $objeto;
    }

    public static function atualizarDescricao($novaDescricao,$id)
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR_DESCRICAO);
        $comando->bindValue(1, $novaDescricao, PDO::PARAM_STR);
        $comando->bindValue(2, $id, PDO::PARAM_INT);
        $comando->execute();
    } 

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }
    protected function verificarErros()
    {
        if (strlen($this->descricao) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['u_nome'],
                $registro['email'],
                '',
                null,
                $registro['u_id']
            );
      
            $objetos[] = new Foto(
                $registro['u_id'],
                $registro['titulo'],
                $registro['descricao'],
                $registro['data_up'],
                $registro['hash_fotos'],
                $usuario,
                $registro['f_id'],
            );
        }
        return $objetos;
    }
 
}
