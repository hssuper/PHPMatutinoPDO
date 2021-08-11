<?php
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/dao/DaoPessoa.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Pessoa.php';

class PessoaController {
    
    public function inserirPessoa($nome, $logradouro, 
            $complemento, $bairro, $cidade, $uf, $cep,
            $dtNasc, $login, $senha, $perfil,$email,$cpf){
        
        $endereco = new fkEndereco();
        $endereco->setCep($cep);
        $endereco->setLogradouro($logradouro);
        $endereco->setComplemento($complemento);
        $endereco->setBairro($bairro);
        $endereco->setCidade($cidade);
        $endereco->setUf($uf);
        
                            $pessoa = new pessoa();              
                            $pessoa->setNome($nome);
                            $pessoa->setDtNasc($dtNasc);
                            $pessoa->setLogin($login);
                            $pessoa->setSenha($senha);
                            $pessoa->setPerfil($perfil);
                            $pessoa->setEmail($email);
                            $pessoa->setCpf($cpf);
                
        $pessoa->setfkEndereco($endereco);
        
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->inserir($pessoa);
    }
    
    //método para atualizar dados de produto no BD
    public function atualizarPessoa($idPessoa, $nome,
            $logradouro, $complemento, $bairro, $cidade, $uf, 
            $cep, $dtNasc, $login, $senha,$perfil,$email,$cpf){
        

        $endereco = new fkEndereco();
        $endereco->setCep($cep);
        $endereco->setLogradouro($logradouro);
        $endereco->setComplemento($complemento);
        $endereco->setBairro($bairro);
        $endereco->setCidade($cidade);
        $endereco->setUf($uf);
        
                            $pessoa = new pessoa();   
                            $pessoa->setIdpessoa($idPessoa);           
                            $pessoa->setNome($nome);
                            $pessoa->setDtNasc($dtNasc);
                            $pessoa->setLogin($login);
                            $pessoa->setSenha($senha);
                            $pessoa->setPerfil($perfil);
                            $pessoa->setEmail($email);
                            $pessoa->setCpf($cpf);
       
        $pessoa->setfkEndereco($endereco); 

        

        $daoPessoa = new DaoPessoa();
        return $daoPessoa->atualizarPessoaDAO($pessoa);
    }
    
    //método para carregar a lista de produtos que vem da DAO
    public function listarPessoas(){
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->listarPessoasDAO();
    }
    
    //método para excluir produto
    public function excluirPessoa($id){
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->excluirPessoaDAO($id);
    }
    
    //método para retornar objeto produto com os dados do BD
    public function pesquisarPessoaId($id){
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->pesquisarPessoaIdDAO($id);
    }
    
    //método para limpar formulário
    public function limpar(){
        return $fr = new Pessoa();
    }
}
