<?php
require_once "C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/dao/daoPessoa.php";
require_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Pessoa.php';
class PessoController {

    public function inserirpessoa($nome, $dtNasc, 
            $login, $senha, $perfil,$email,$cpf,$fkEndereco){
        $pessoa = new pessoa();
        $pessoa->setnome($nome);
        $pessoa->setdtNasc($dtNasc);
        $pessoa->setlogin($login);
        $pessoa->setsenha($senha);
        $pessoa->setperfil($perfil);
        $pessoa->setEmail($email);
        $pessoa->setcpf($cpf);
        $pessoa->setfkEndereco($fkEndereco);
        
        $daopessoa = new Daopessoa();
        return $daopessoa->inserir($pessoa);
    }
    
    //método para atualizar dados de pessoa no BD
    public function atualizarpessoa($id, $nome, $dtNasc, 
            $login, $senha,$perfil){
        $pessoa = new pessoa();
        $pessoa->setIdpessoa($id);
        $pessoa->setnome($nome);
        $pessoa->setdtNasc($dtNasc);
        $pessoa->setlogin($login);
        $pessoa->setsenha($senha);
        $pessoa->setperfil($perfil);
        
        $daopessoa = new Daopessoa();
        return $daopessoa->atualizarpessoaDAO($pessoa);
    }
    
    //método para carregar a lista de pessoas que vem da DAO
    public function listarpessoas(){
        $daopessoa = new Daopessoa();
        return $daopessoa->listarpessoasDAO();
    }
    
    //método para excluir pessoa
    public function excluirpessoa($id){
        $daopessoa = new Daopessoa();
        return $daopessoa->excluirpessoaDAO($id);
    }
    
    //método para retornar objeto pessoa com os dados do BD
    public function pesquisarpessoaId($id){
        $daopessoa = new Daopessoa();
        return $daopessoa->pesquisarpessoaIdDAO($id);
    }
    
    //método para limpar formulário
    public function limpar(){
        return $pr = new pessoa();
    }
}
