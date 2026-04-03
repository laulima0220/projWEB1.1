<?php
declare(strict_types=1);
namespace src\projeto;
class Produto{
    private string $nome;
    public function setNome(string $novoN):void{
        $this->nome=$novoN;
    }
    public function getNome(): string{
        return $this->nome;
    }

    private float $preço;
    public function setPreço(float $novoP):void{
        if ($novoP <= 0) {
            throw new \InvalidArgumentException(
                'O preço do produto não pode ser negativo!!!'
            );
        }
        $this->preço = $novoP;
        }
        public function getPreço(): float{
            return $this->preço;
    }

    private int $qtdEstoque;
    public function setQtdE(float $novoE):void{
    if ($novoE <= 0) {
            throw new \InvalidArgumentException(
                'A quantidade de produtos no estoque não pode ser negativa!!!'
            );  
    }
    $this->qtdEstoque = $novoE;
    }
    public function getQtdE(): int{
        return $this->qtdEstoque; 
    }

    private int $AddE;
    public function setAddE(int $novoE):void{
        if ($novoE <= 0) {
            throw new \InvalidArgumentException(
                'Não é possível adicionar números negativos ao estoque!!'
            );    
    }
    $this->AddE = $novoE;
    }

    private int $RemE;
    public function setRemE(int $novoE):void{
        if ($novoE <= 0) {
            throw new \InvalidArgumentException(
                'Não é possível remover números negativos do estoque!!'
            );   
    }
    $this->RemE = $novoE;
    }

    public function NovoE(): int{
        $this->qtdEstoque+=$this->AddE;
        return $this->qtdEstoque;
    }

    public function calcularTotalE(): float{
        return $this-> qtdEstoque * $this-> preço;
    }
}