<?php
namespace Controlador;

// use \Modelo\Reclamacao;
use \Modelo\Usuario;
use \Framework\DW3Sessao;
use \Modelo\Foto;

class HomeControlador extends Controlador
{
    public function index()
    {
        $this->verificarLogado();
        $usuarioBuscado = null;
        $usuarioExterno = false;
        if (isset($_GET["buscando"])) {
            $usuarioBuscado = Usuario::buscarNome($_GET["buscando"]);
        }
        // $this->nomeUsuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $paginacao = $this->calcularPaginacao();
        $this->verificarLogado();
        $this->visao('home/criar.php', [
            'usuario' => $this->getUsuario(),
            'pagina' => $paginacao['pagina'],
            'arquivos' => $paginacao['arquivos'],
            'buscaUsuarios' => $usuarioBuscado,
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ], 'home.php');
    }

    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $arquivos = Foto::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Foto::contarTodos() / $limit);
        return compact('pagina', 'arquivos', 'ultimaPagina');
    }

    public function criar()
    {
        $this->verificarLogado();
        $this->visao('home/criar.php', [
            'usuario' => $this->getUsuario()
        ], 'home.php');
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
                        $this->redirecionar(URL_RAIZ . 'home');
                    } else {
                        echo "errado";
                    }
                    
                } 
            }
        }
    }
}
