<?php
declare(strict_types=1);
namespace src\projeto;

class Produto{

    public function getValorTotal(): float {
        return $this->preco * $this->qtdEstoque;
    }
    
    private int $qtdEstoque = 0;
    public function setEstoque(int $novoE):void{
        if($novoE<0){
            throw new \InvalidArgumentException(
                'A quantidade não pode ser negativa!!!'
            );
        }
        $this->qtdEstoque=$novoE;
    }
    public function getEstoque():int{
        return $this->qtdEstoque;
    }

    public function addEstoque(int $novoE):void{
        if($novoE<=0){
            throw new \InvalidArgumentException(
                'A quantidade não pode ser negativa!!!'
            );
        }
        $this->qtdEstoque+=$novoE;
    }
    public function delEstoque(int $novoE):void{
        if($novoE<0){
            throw new \InvalidArgumentException(
                'A quantidade não pode ser negativa!!!'
            );
        }
        if ($novoE > $this->qtdEstoque) {
            throw new \InvalidArgumentException(
                'Estoque insuficiente!'
            );
        }
        $this->qtdEstoque-=$novoE;
    }

    private string $nome;
    public function setNome(string $novoN):void{    
        $this->nome=$novoN;
    }
    public function getNome(): string{
        return $this->nome;
    }

    private float $preco;
    public function setPreco(float $novoP):void{
        if ($novoP <= 0) {
            throw new \InvalidArgumentException(
                'O preço não pode ser negativo!!!'
            );
        }
        $this->preco = $novoP;
    }
    public function getPreco(): float{
        return $this->preco;
    }

}