<?php
declare(strict_types=1);
namespace src\projeto;
class Pessoa{
    private string $nome;
    public function setNome(string $novoN):void{    
        $this->nome=$novoN;
    }
    public function getNome(): string{
        return $this->nome;
    }


    private float $peso;
    public function setPeso(float $novoP):void{
        if ($novoP <= 0) {
            throw new \InvalidArgumentException(
                'O peso não pode ser negativo!!!'
            );
        }
        $this->peso = $novoP;
    }
    public function getPeso(): float{
        return $this->peso;
    }


    private float $altura;
    public function setAltura(float $novaA):void{
        if ($novaA <= 0) {
            throw new \InvalidArgumentException(
                'A altura não pode ser negativa!!!'
            );
        }
        $this->altura= $novaA;
    }
    public function getAltura(): float{
        return $this->altura;
    }

    public function calcularIMC():float{
        return $this->peso / ($this->altura * $this->altura);        
    }

    public function MensagemIMC():string{
        $imc = $this->calcularIMC();
        if ($imc < 18.5) {
            return "Abaixo do peso";
        } elseif ($imc < 25) {
            return "Peso normal";
        } elseif ($imc < 30) {
            return "Sobrepeso";
        } else {
            return "Obesidade";
        }
    }
}