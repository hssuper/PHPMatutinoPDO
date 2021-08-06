<?php
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/bd/Conecta.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Produto.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Mensagem.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Fornecedor.php';

class DaoProduto {

    public function inserir(Produto $produto){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $nomeProduto = $produto->getNomeProduto();
            $vlrCompra = $produto->getVlrCompra();
            $vlrVenda = $produto->getVlrVenda();
            $qtdEstoque = $produto->getQtdEstoque();
            $nomeFornecedor = $produto->getFornecedor()->getNomeFornecedor();
            try {
                //processo para pegar o idfornecedor da tabela fornecedor, conforme 
                //o nomeFornecedor.
                $st = $conecta->prepare("select idFornecedor "
                        . "from fornecedor where nomefornecedor = ? "
                        . " limit 1");
                $st->bindParam(1, $nomeProduto);
                $st->bindParam(2, $vlrCompra);
                $st->bindParam(3, $vlrVenda);
                $st->bindParam(4, $qtdEstoque);
                $st->bindParam(5, $nomeFornecedor);
                if($st->execute()){
                    if($st->rowCount() > 0){
                        $msg->setMsg("".$st->rowCount());
                        while($linha = $st->fetch(PDO::FETCH_OBJ)){
                            $fkEnd = $linha->idfornecedor;
                        }
                        //$msg->setMsg("$fkEnd");
                    }else{
                        $st2 = $conecta->prepare("insert into "
                                . "fornecedor values (null,?)");
                        $st2->bindParam(1, $nomeFornecedor);
                        
                       
                        $st2->execute();

                        $st3 = $conecta->prepare("select idfornecedor "
                            . "from fornecedor where nomefornecedor = ? "
                            . " limit 1");
                        $st3->bindParam(1, $nomeFornecedor);
                       
                        if($st3->execute()){
                            if($st3->rowCount() > 0){
                                $msg->setMsg("".$st3->rowCount());
                                while($linha = $st3->fetch(PDO::FETCH_OBJ)){
                                    $fkEnd = $linha->idendereco;
                                }
                                //$msg->setMsg("$fkEnd");
                            }
                        }
                    }
                    
                    //processo para inserir dados de fornecedor
                    $stmt = $conecta->prepare("insert into produto values "
                            . "(null,?,?,?,?,?)");
                    $stmt->bindParam(1, $$nomeProduto);
                    $stmt->bindParam(2, $vlrCompra);
                    $stmt->bindParam(3, $vlrVenda);
                    $stmt->bindParam(4, $qtdEstoque);
                    $stmt->bindParam(5, $nomeFornecedor);
                    $stmt->execute();
                }
                
                //$msg->setMsg("<p style='color: green;'>"
                        //. "Dados Cadastrados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
           
        return $msg;
    }
    
    //método para atualizar dados da tabela produto
    public function atualizarProdutoDAO(Produto $produto){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $id = $produto->getIdProduto();
            $nomeProduto = $produto->getNomeProduto();
            $vlrCompra = $produto->getVlrCompra();
            $vlrVenda = $produto->getVlrVenda();
            $qtdEstoque = $produto->getQtdEstoque();
            $nomeFornecedor = $produto->getFornecedor()->getNomeFornecedor();
            try{
                $st = $conecta->prepare("select idfornecedor "
                . "from fornecedor where nomefornecedor = ?  "
                . " limit 1");
        $st->bindParam(1, $nomefornecedor);
        
        $id = "";
        if($st->execute()){
            if($st->rowCount() > 0){
                //$msg->setMsg("".$st->rowCount());
                while($linha = $st->fetch(PDO::FETCH_OBJ)){
                    $id = $linha->idendereco;
                }
                //$msg->setMsg("$fkEnd");
            }else{
                $st2 = $conecta->prepare("insert into "
                        . "endereco values (null,?,?,?,?,?,?)");
                $st2->bindParam(1, $logradouro);
                $st2->bindParam(2, $complemento);
                $st2->bindParam(3, $bairro);
                $st2->bindParam(4, $cidade);
                $st2->bindParam(5, $uf);
                $st2->bindParam(6, $cep);
                $st2->execute();
                
                $st3 = $conecta->prepare("select idendereco "
                    . "from endereco where cep = ? and "
                    . "logradouro = ? and complemento = ? limit 1");
                $st3->bindParam(1, $cep);
                $st3->bindParam(2, $logradouro);
                $st3->bindParam(3, $complemento);
                if($st3->execute()){
                    if($st3->rowCount() > 0){
                        $linha = $st3->fetch(PDO::FETCH_OBJ);
                        $fkEnd = $linha->idendereco;
                    }
                }
            }
        }




                $stmt = $conecta->prepare("update produto set "
                        . "nome = ?,"
                        . "vlrCompra = ?,"
                        . "vlrVenda = ?, "
                        . "qtdEstoque = ?, "
                        . "nomeFornecedor = ? "
                        . "where id = ?");
                $stmt->bindParam(1, $nomeProduto);
                $stmt->bindParam(2, $vlrCompra);
                $stmt->bindParam(3, $vlrVenda);
                $stmt->bindParam(4, $qtdEstoque);
                $stmt->bindParam(5, $nomeFornecedor);
                $stmt->bindParam(6, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: blue;'>"
                        . "Dados atualizados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }
    
    //método para carregar lista de produtos do banco de dados
    public function listarProdutoDAO(){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
            try {
                $rs = $conecta->query("SELECT * FROM produto inner join fornecedor "
                        . "on produto.fkFornecedor = fornecedor.idfornecedor "
                        . "order by produto.id desc");
                $lista = array();
                $a = 0;
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $produto = new Produto();
                            $produto->setIdProduto($linha->id);
                            $produto->setNomeProduto($linha->nome);
                            $produto->setVlrCompra($linha->vlrCompra);
                            $produto->setVlrVenda($linha->vlrVenda);
                            $produto->setQtdEstoque($linha->qtdEstoque);
                            
                            $forn = new Fornecedor();
                        
                            $forn->setIdfornecedor($linha->idfornecedor);
                           
                            

                            $produto->setFornecedor($forn);
                            
                            $lista[$a] = $produto;
                            $a++;
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;           
            return $lista;
        }
    }
    
    //método para excluir produto na tabela produto
    public function excluirProdutoDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
             try {
                $stmt = $conecta->prepare("delete from produto "
                        . "where id = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: #d6bc71;'>"
                        . "Dados excluídos com sucesso.</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>"); 
        }
        $conn = null;
        return $msg;
    }
    
    //método para os dados de produto por id
    public function pesquisarProdutoIdDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        $produto = new Produto();
        if($conecta){
            try {
                $rs = $conecta->prepare("select * from produto inner join "
                        . "fornecedor on produto.fkFornecedor = fornecedor.idfornecedor "
                        . "where produto.id = ?");
                $rs->bindParam(1, $id);
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $produto->setIdProduto($linha->id);
                            $produto->setNomeProduto($linha->nome);
                            $produto->setVlrCompra($linha->vlrCompra);
                            $produto->setVlrVenda($linha->vlrVenda);
                            $produto->setQtdEstoque($linha->qtdEstoque);
                            
                            $forn = new Fornecedor();
                           
                            
                            $forn->setNomeFornecedor($linha->nomeFornecedor);
                            $forn->setIdfornecedor($linha->idfornecedor);
                            
                            
                            $produto->setFornecedor($forn);
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;
        }else{
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../PHPMatutinoPDO/cadastroProduto.php'\">"; 
        }
        return $produto;
    }
}
