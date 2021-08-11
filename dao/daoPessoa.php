<?php

require_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/bd/Conecta.php';
require_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Pessoa.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Endereco.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/PHPMatutinoPDO/model/Mensagem.php';

class daoPessoa {

    public $conn;

    public function inserir(Pessoa $pessoa){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            
            $logradouro = $pessoa->getfkEndereco()->getLogradouro();
            $complemento = $pessoa->getfkEndereco()->getComplemento();
            $bairro = $pessoa->getfkEndereco()->getBairro();
            $cidade = $pessoa->getfkEndereco()->getCidade();
            $uf = $pessoa->getfkEndereco()->getUf();
            $cep = $pessoa->getfkEndereco()->getCep();

            $nome = $pessoa->getNome();
            $dtNasc = $pessoa->getDtNasc();
            $login = $pessoa->getLogin();
            $senha = $pessoa->getSenha();
            $perfil = $pessoa->getPerfil();
            $email = $pessoa->getEmail();
            $cpf = $pessoa->getCpf();
            

            try {

                    //processo para pegar o idendereco da tabela endereco, conforme 
                    //o cep, o logradouro e o complemento informado.
                    $st = $conecta->prepare("select idendereco "
                            . "from endereco where cep = ? and "
                            . "logradouro = ? and complemento = ? limit 1");
                    $st->bindParam(1, $cep);
                    $st->bindParam(2, $logradouro);
                    $st->bindParam(3, $complemento);
                    if($st->execute()){
                        if($st->rowCount() > 0){
                            $msg->setMsg("".$st->rowCount());
                            while($linha = $st->fetch(PDO::FETCH_OBJ)){
                                $fkEnd = $linha->idendereco;
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
                                    $msg->setMsg("".$st3->rowCount());
                                    while($linha = $st3->fetch(PDO::FETCH_OBJ)){
                                        $fkEnd = $linha->idendereco;
                                    }
                                    //$msg->setMsg("$fkEnd");
                                }
                            }
                        }

                $stmt = $conecta->prepare("insert into pessoa values "
                        . "(null,?,?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $dtNasc);
                $stmt->bindParam(3, $login);
                $stmt->bindParam(4, $senha);
                $stmt->bindParam(5, $perfil);
                $stmt->bindParam(6, $email);
                $stmt->bindParam(7, $cpf);
                $stmt->bindParam(8, $fkEnd);
                $stmt->execute();
                    }
                
            }catch (ErrorException $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
           
        return $msg;
    }
    
    //método para atualizar dados da tabela pessoa
    public function atualizarpessoaDAO(pessoa $pessoa){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            

            $idpessoa = $pessoa->getIdpessoa();
            $nome = $pessoa->getNome();
            $dtNasc = $pessoa->getDtNasc();
            $login = $pessoa->getLogin();
            $senha = $pessoa->getSenha();
            $perfil = $pessoa->getPerfil();
            $email = $pessoa->getEmail();
            $cpf = $pessoa->getCpf();

            $logradouro = $pessoa->getfkEndereco()->getLogradouro();
            $complemento = $pessoa->getfkEndereco()->getComplemento();
            $bairro = $pessoa->getfkEndereco()->getBairro();
            $cidade = $pessoa->getfkEndereco()->getCidade();
            $uf = $pessoa->getfkEndereco()->getUf();
            $cep = $pessoa->getfkEndereco()->getCep();

            
           
            try{
                //processo para pegar o idendereco da tabela endereco, conforme 
                //o cep, o logradouro e o complemento informado.
                $st = $conecta->prepare("select idendereco "
                        . "from endereco where cep = ? and "
                        . "logradouro = ? and complemento = ? limit 1");
                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
                $fkEnd = "";
                if($st->execute()){
                    if($st->rowCount() > 0){
                        //$msg->setMsg("".$st->rowCount());
                        while($linha = $st->fetch(PDO::FETCH_OBJ)){
                            $fkEnd = $linha->idendereco;
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
                $stmt = $conecta->prepare("update Pessoa set "
                        . "nome = ?,"
                        . "dtNasc = ?, "
                        . "login = ?, "
                        . "senha = ?, "
                        . "perfil = ?, "
                        . "email = ?, "
                        . "cpf = ?, "
                        . "fkendereco = ? "
                        . "where idpessoa = ?");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $dtNasc);
                $stmt->bindParam(3, $login);
                $stmt->bindParam(4, $senha);
                $stmt->bindParam(5, $perfil);
                $stmt->bindParam(6, $email);
                $stmt->bindParam(7, $cpf);
                $stmt->bindParam(8, $fkEnd);
                $stmt->bindParam(9, $idpessoa);
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
    
    //método para excluir produto na tabela produto
    public function excluirpessoaDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
             try {
                $stmt = $conecta->prepare("delete from pessoa "
                        . "where idpessoa = ?");
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
    public function pesquisarpessoaIdDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $pessoa = new pessoa();
        if($conecta){
            try {
                $rs = $conecta->prepare("select * from pessoa inner join endereco "
                . " on pessoa.fkendereco = endereco.idendereco where "
                . "idpessoa = ? limit 1");
                $rs->bindParam(1, $id);
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $pessoa = new pessoa();
                            $pessoa->setIdpessoa($linha->idpessoa);
                            $pessoa->setNome($linha->nome);
                            $pessoa->setDtNasc($linha->dtNasc);
                            $pessoa->setLogin($linha->login);
                            $pessoa->setSenha($linha->senha);
                            $pessoa->setPerfil($linha->perfil);
                            $pessoa->setEmail($linha->email);
                            $pessoa->setCpf($linha->cpf);
                            $endereco = new Endereco();
                            $endereco->setLogradouro($linha->logradouro);
                            $endereco->setComplemento($linha->complemento);
                            $endereco->setBairro($linha->bairro);
                            $endereco->setCidade($linha->cidade);
                            $endereco->setUf($linha->uf);
                            $endereco->setCep($linha->cep);
                            $pessoa->setFkEndereco($endereco);
                        }
                    }
                }
            } catch (Exception $ex) {
                
            }  
            $conn = null;
        }else{
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../PHPMatutinoPDO/cadastropessoa.php'\">"; 
        }
        return $pessoa;
    }
    public function listarPessoasDAO(){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
            try {
                $rs = $conecta->query("select * from Pessoa inner join endereco "
                        . " on Pessoa.fkendereco = endereco.idendereco");
                $lista = array();

                $a = 0;
                
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $endereco = new Endereco();
                            $endereco->setLogradouro($linha->logradouro);
                            $endereco->setComplemento($linha->complemento);
                            $endereco->setBairro($linha->bairro);
                            $endereco->setCidade($linha->cidade);
                            $endereco->setUf($linha->uf);
                            $endereco->setCep($linha->cep);

                            $Pessoa = new Pessoa();
                            $Pessoa->setIdPessoa($linha->idpessoa);
                            $Pessoa->setNome($linha->nome);
                            $Pessoa->setDtNasc($linha->dtNasc);
                            $Pessoa->setLogin($linha->login);
                            $Pessoa->setSenha($linha->senha);
                            $Pessoa->setPerfil($linha->perfil);
                            $Pessoa->setEmail($linha->email);
                            $Pessoa->setCpf($linha->cpf);

                            $lista[$a] = $Pessoa;
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

}