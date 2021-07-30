<?php

class Fornecedor {
    private $idfornecedor;
    private $nomeFornecedor;
    private $logradouro;
    private $complemento;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $representante;
    private $email;
    private $telFixo;
    private $telCel;
    
    function getIdfornecedor() {
        return $this->idfornecedor;
    }

    function getNomeFornecedor() {
        return $this->nomeFornecedor;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function getCep() {
        return $this->cep;
    }

    function getRepresentante() {
        return $this->representante;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelFixo() {
        return $this->telFixo;
    }

    function getTelCel() {
        return $this->telCel;
    }

    function setIdfornecedor($idfornecedor) {
        $this->idfornecedor = $idfornecedor;
    }

    function setNomeFornecedor($nomeFornecedor) {
        $this->nomeFornecedor = $nomeFornecedor;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setRepresentante($representante) {
        $this->representante = $representante;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelFixo($telFixo) {
        $this->telFixo = $telFixo;
    }

    function setTelCel($telCel) {
        $this->telCel = $telCel;
    }

}
