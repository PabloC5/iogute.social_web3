<?php
namespace Controlador;

// use \Modelo\Reclamacao;
use \Modelo\Usuario;
use \PDO;
use \Framework\DW3Sessao;
use \Framework\DW3BancoDeDados;

class PerfilControlador extends Controlador
{
    const INSERIR = 'INSERT INTO fotos(usuario_id, titulo, descricao, data_up, hash_fotos) VALUES (?, ?, ?, ?, ?)';
    private $id;
    protected $nomeUsuario; 

    // public function criar()
    // {
    //     $this->verificarLogado();
    //     $this->nomeUsuario = Usuario::buscarId(DW3Sessao::get('usuario'));
    //     $this->visao('perfil/criar.php', [
    //         'usuario' => $this->getUsuario()
    //     ], 'perfil.php');
    // }

    public function index()
    {
        $this->verificarLogado();
        $this->nomeUsuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $this->visao('perfil/criar.php', [
            'usuario' => $this->getUsuario()
        ], 'perfil.php');
    }

    public function armazenar()
    {
        $this->verificarLogado();
        
        if (isset($_POST['acao'])) {
            $arquivo = $_FILES['file'];
            $pasta = 'publico/img/';
            $nomeDoarquivo = $arquivo['name'];
            $novoNomeArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoarquivo, PATHINFO_EXTENSION));
            if ($extensao != 'jpg' && $extensao != 'png') 
                echo "Tipo de arquivo incorreto";
            else {
                $pathFinal = $pasta . $novoNomeArquivo . "." . $extensao;
                if (move_uploaded_file($arquivo["tmp_name"], $pathFinal)) {
                    $arquivo = new Arquivo(
                        DW3Sessao::get('usuario'),
                        "titulo",
                        "descritivo",
                        date("Y-m-d H:i:s"),
                        $pathFinal,
                        null,
                        null
                    );
                    if ($arquivo->isValido()) {
                        $arquivo->salvar();
                        DW3Sessao::setFlash('mensagemFlash', 'Foto carregada com sucesso');
                        // $this->redirecionar(URL_RAIZ . 'arquivos');
                    } else {
                        echo "errado";
                    }
                    
                } 
            }

            
            // $upCorreto = move_uploaded_file($arquivo["tmp_name"], $pasta . $novoNomeArquivo . "." . $extensao);
        }
        // $this->visao('perfil/criar.php', [
        //     'usuario' => $this->getUsuario()
        // ], 'perfil.php');
    }
   
}
