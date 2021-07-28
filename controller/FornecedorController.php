<?php
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/dao/DaoFornecedor.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Fornecedor.php';

class FornecedorController {
    
    public function inserirFornecedor($nomeFornecedor, $logradouro, 
            $numero, $complemento, $bairro, $cidade, $uf, $cep,
            $representante, $email, $telFixo, $telCel){
        $fornecedor = new Fornecedor();
        $fornecedor->setNomeFornecedor($nomeFornecedor);
        $fornecedor->setLogradouro($logradouro);
        $fornecedor->setNumero($numero);
        $fornecedor->setComplemento($complemento);
        $fornecedor->setBairro($bairro);
        $fornecedor->setCidade($cidade);
        $fornecedor->setUf($uf);
        $fornecedor->setCep($cep);
        $fornecedor->setRepresentante($representante);
        $fornecedor->setEmail($email);
        $fornecedor->setTelFixo($telFixo);
        $fornecedor->setTelCel($telCel);
        
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->inserir($fornecedor);
    }
    
    //método para atualizar dados de produto no BD
    public function atualizarFornecedor($idfornecedor, $nomeFornecedor,
            $logradouro, $numero, $complemento, $bairro, $cidade, $uf, 
            $cep, $representante, $email, $telFixo, $telCel){
        $fornecedor = new Fornecedor();
        $fornecedor->setIdfornecedor($idfornecedor);
        $fornecedor->setNomeFornecedor($nomeFornecedor);
        $fornecedor->setLogradouro($logradouro);
        $fornecedor->setNumero($numero);
        $fornecedor->setComplemento($complemento);
        $fornecedor->setBairro($bairro);
        $fornecedor->setCidade($cidade);
        $fornecedor->setUf($uf);
        $fornecedor->setCep($cep);
        $fornecedor->setRepresentante($representante);
        $fornecedor->setEmail($email);
        $fornecedor->setTelFixo($telFixo);
        $fornecedor->setTelCel($telCel);
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->atualizarFornecedorDAO($fornecedor);
    }
    
    //método para carregar a lista de produtos que vem da DAO
    public function listarFornecedores(){
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->listarFornecedorsDAO();
    }
    
    //método para excluir produto
    public function excluirFornecedor($id){
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->excluirFornecedorDAO($id);
    }
    
    //método para retornar objeto produto com os dados do BD
    public function pesquisarFornecedorId($id){
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->pesquisarFornecedorIdDAO($id);
    }
    
    //método para limpar formulário
    public function limpar(){
        return $fr = new Fornecedor();
    }
}
