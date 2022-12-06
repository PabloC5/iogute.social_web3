<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;
use \Modelo\Foto;

class PerfilControlador extends Controlador
{
    protected $nomeUsuario; 
    protected $usuarioTeste;

    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $arquivos = Foto::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Foto::contarTodos() / $limit);
        return compact('pagina', 'arquivos', 'ultimaPagina');
    }

    public function index()
    {
        $this->verificarLogado();
        $this->nomeUsuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $this->usuarioTeste = DW3Sessao::get('usuario');
        $usuarioBuscado = null;
        $usuarioExterno = false;
        if (isset($_GET["buscando"])) {
            $usuarioBuscado = Usuario::buscarNome($_GET["buscando"]);
        }
        $paginacao = $this->calcularPaginacao();
        $this->visao('perfil/criar.php', [
            'usuario' => $this->getUsuario(),
            'pagina' => $paginacao['pagina'],
            'arquivos' => $paginacao['arquivos'],
            'buscaUsuarios' => $usuarioBuscado,
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ], 'perfil.php');
    }

    public function perfilUsers()
    {
        $this->verificarLogado();
        $this->nomeUsuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $this->usuarioTeste = DW3Sessao::get('usuario');
        $usuarioBuscadoSelec = null;
        $usuarioExterno = true;
        // if (isset($_GET["buscando"])) {
        $usuarioBuscadoSelec = null;
        $usuarioBuscadoSelec = Usuario::buscarNomeSelect($_GET["selectNomes"]);
        // }
        var_dump($usuarioBuscadoSelec);
        $paginacao = $this->calcularPaginacao();
        $this->visao('contas/criar.php', [
            'usuario' => $this->getUsuario(),
            'pagina' => $paginacao['pagina'],
            'arquivos' => $paginacao['arquivos'],
            'buscaUsuarios' => $usuarioBuscadoSelec,
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'usuarioExterno' => $usuarioExterno,
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ], 'perfil.php');
    }

    public function armazenar()
    {
        $this->verificarLogado();
        if (isset($_POST['acao'])) {
            $arquivo = $_FILES['file'];
            // var_dump($arquivo);
            $pasta = 'publico/img/';
            $nomeDoarquivo = $arquivo['name'];
            $novoNomeArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoarquivo, PATHINFO_EXTENSION));
            if ($extensao != 'jpg' && $extensao != 'png') 
                echo "Tipo de arquivo incorreto";
            else {
                $pathFinal = $pasta . $novoNomeArquivo . "." . $extensao;
                if (move_uploaded_file($arquivo["tmp_name"], $pathFinal)) {
                    $arquivo = new Foto(
                        DW3Sessao::get('usuario'),
                        $_POST['titulo'],
                        $_POST['descricao'],
                        date("Y-m-d H:i:s"),
                        $pathFinal,
                        null,
                        null
                    );
                    
                    if ($arquivo->isValido()) {
                        $arquivo->salvar();
                        DW3Sessao::setFlash('mensagemFlash', 'Foto carregada com sucesso');
                        $this->redirecionar(URL_RAIZ . 'perfil');
                        
                    } else {
                        echo "errado";
                    }
                    
                } 
            }
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $foto = Foto::buscarId($id);
        // var_dump($foto);
        if ($foto->getUsuarioId() == $this->getUsuario()) {
            Foto::destruir($id);
            // DW3Sessao::setFlash('mensagemFlash', 'Foto apagada.');
        } else {
            echo "errado néee";
            // DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'perfil');
    }
   
}
