<?php
include_once 'controller/PessoaController.php';
include_once './model/Pessoa.php';
include_once './model/Mensagem.php';
include_once './model/Endereco.php';
$pc = new PessoController();
$msg = new Mensagem();
$pr = new Pessoa();
$Pessoa = new Pessoa();
$pf->setfkEndereco($fkEndereco);
$btEnviar = FALSE;
$btAtualizar = FALSE;
$btExcluir = FALSE;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            .btInput{
                margin-top: 20px;
            }
            .pad15{
                padding-bottom: 15px; padding-top: 15px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card-header bg-dark text-center border
                         text-white"><strong>Cadastro de Pessoa</strong>
                    </div>
                    <div class="card-body border">
                        <?php
                        //envio dos dados para o BD
                        if (isset($_POST['cadastrarPessoa'])) {
                            $nome = trim($_POST['nome']);
                            if ($nome != "") {
                                $dtNasc = $_POST['dtNasc'];
                                $login = $_POST['login'];
                                $senha = $_POST['senha'];
                                $perfil = $_POST['perfil'];
                                $email = $_POST['email'];
                                $cpf = $_POST['cpf'];
                                $idPessoa = $_POST['idPessoa'];

                                $pc = new PessoController();
                                unset($_POST['cadastrarPessoa']);
                                $msg = $pc->inserirPessoa($nome, $dtNasc, $login, $senha,$perfil,$email,$cpf, $idPessoa );
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroPessoa.php'\">";
                            }
                        }
                        
                        //método para atualizar dados do Pessoa no BD
                        if (isset($_POST['atualizarPessoa'])) {
                            $nomePessoa = trim($_POST['nome']);
                            if ($nomePessoa != "") {
                                $fkPessoa = $_POST['idPessoa'];
                                $dtNasc = $_POST['dtNasc'];
                                $login = $_POST['login'];
                                $senha = $_POST['senha'];
                                $perfil = $_POST['perfil'];
                                $email = $_POST['email'];
                                $cpf = $_POST['cpf'];
                                
                                

                                $pc = new PessoController();
                                unset($_POST['atualizarPessoa']);
                                $msg = $pc->atualizarPessoa($idPessoa, $nome, $dtNasc, $login, $senha,$perfil,$email,$cpf);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroPessoa.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluir'])) {
                            if ($pr != null) {
                                $id = $_POST['ide'];
                                
                                $pc = new PessoController();
                                unset($_POST['excluir']);
                                $msg = $pc->excluirPessoa($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroPessoa.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluirPessoa'])) {
                            if ($pr != null) {
                                $id = $_POST['idPessoa'];
                                unset($_POST['excluirPessoa']);
                                $pc = new PessoController();
                                $msg = $pc->excluirPessoa($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroPessoa.php'\">";
                            }
                        }

                        if (isset($_POST['limpar'])) {
                            $pr = null;
                            unset($_GET['id']);
                            header("Location: cadastroPessoa.php");
                        }
                        if (isset($_GET['id'])) {
                            $btEnviar = TRUE;
                            $btAtualizar = TRUE;
                            $btExcluir = TRUE;
                            $id = $_GET['id'];
                            $pc = new PessoController();
                            $pr = $pc->pesquisarPessoaId($id);
                        }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Código: <label style="color:red;">
                                            <?php
                                            if ($pr != null) {
                                                echo $pr->getIdPessoa();
                                                ?>
                                            </label></strong>
                                        <input type="hidden" name="idPessoa" 
                                               value="<?php echo $pr->getIdPessoa(); ?>"><br>
                                               <?php
                                           }
                                           ?>     
                                    <label>Nome</label>  
                                    <input class="form-control" type="text" 
                                           name="nome" 
                                           value="<?php echo $pr->getNome(); ?>">
                                    <label>Data Nasc</label>  
                                    <input class="form-control" type="date" 
                                           value="<?php echo $pr->getDtNasc(); ?>" name="dtNasc">  
                                    <label>login</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $pr->getLogin(); ?>" name="login"> 
                                    <label>senha</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $pr->getSenha(); ?>" name="senha">
                                           <label>perfil</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $pr->getPerfil(); ?>" name="perfil">
                                           <label>email</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $pr->getEmail(); ?>" name="email">
                                           <label>Cpf</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $pr->getCpf(); ?>" name="cpf">
                                           <label>Endereco</label>  
                                    

                                          }
                                        ?>
                                    </select>
                                    <input type="submit" name="cadastrarPessoa"
                                           class="btn btn-success btInput" value="Enviar"
                                           <?php if($btEnviar == TRUE) echo "disabled"; ?>>
                                    <input type="submit" name="atualizarPessoa"
                                           class="btn btn-secondary btInput" value="Atualizar"
                                           <?php if($btAtualizar == FALSE) echo "disabled"; ?>>
                                    <button type="button" class="btn btn-warning btInput" 
                                            data-bs-toggle="modal" data-bs-target="#ModalExcluir"
                                            <?php if($btExcluir == FALSE) echo "disabled"; ?>>
                                        Excluir
                                    </button>
                                    <!-- Modal para excluir -->
                                    <div class="modal fade" id="ModalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" 
                                                        id="exampleModalLabel">
                                                        Confirmar Exclusão</h5>
                                                    <button type="button" 
                                                            class="btn-close" 
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Deseja Excluir?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="excluirPessoa"
                                                           class="btn btn-success "
                                                           value="Sim">
                                                    <input type="submit" 
                                                        class="btn btn-light btInput" 
                                                        name="limpar" value="Não">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fim do modal para excluir -->
                                    &nbsp;&nbsp;
                                    <input type="submit" 
                                           class="btn btn-light btInput" 
                                           name="limpar" value="Limpar">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-responsive"
                               style="border-radius: 3px; overflow:hidden;">
                            <thead class="table-dark">
                                <tr><th>Código</th>
                                    <th>Nome</th>
                                    <th>dtNasc</th>
                                    <th>login</th>
                                    <th>senha</th>
                                    <th>perfil</th>
                                    <th>Email</th>
                                    <th>Cpf</th>
                                    <th>Endereco</th>
                                    <th>Ações</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $pcTable = new PessoController();
                                $listarPessoas = $pcTable->listarPessoas();
                                $a = 0;
                                if ($listarPessoas != null) {
                                    foreach ($listarPessoas as $lp) {
                                        $a++;
                                        ?>
                                        <tr>
                                            <td><?php print_r($lp->getIdPessoa()); ?></td>
                                            <td><?php print_r($lp->getNome()); ?></td>
                                            <td><?php print_r($lp->getDtNasc()); ?></td>
                                            <td><?php print_r($lp->getLogin()); ?></td>
                                            <td><?php print_r($lp->getSenha()); ?></td>
                                            <td><?php print_r($lp->getPerfil()); ?></td>
                                            <td><?php print_r($lp->getEmail()); ?></td>
                                            <td><?php print_r($lp->getCpf()); ?></td>
                                            
                                            
                                            <td><a href="cadastroPessoa.php?id=<?php echo $lp->getIdPessoa(); ?>"
                                                   class="btn btn-light">
                                                    <img src="img/edita.png" width="32"></a>
                                                </form>
                                                <button type="button" 
                                                        class="btn btn-light" data-bs-toggle="modal" 
                                                        data-bs-target="#exampleModal<?php echo $a; ?>">
                                                    <img src="img/delete.png" width="32"></button></td>
                                        </tr>
                                        <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" 
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                        <label><strong>Deseja excluir o Pessoa 
                                                                <?php echo $lp->getNomePessoa(); ?>?</strong></label>
                                                        <input type="hidden" name="ide" 
                                                               value="<?php echo $lp->getIdPessoa(); ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="excluir" class="btn btn-primary">Sim</button>
                                                            <button type="reset" class="btn btn-secondary" 
                                                                    data-bs-dismiss="modal">Não</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>     
    </div>


    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    </script> 
     
</body>
</html>

