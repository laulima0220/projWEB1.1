<?php
declare(strict_types=1);
namespace src\projeto;
class Nota{
    public function calcularMedia():float{
        return ($this->nota1 + $this->nota2) / 2;        
    }

    public function SituacaoAluno():string{
        $media = $this->calcularMedia();
        if ($media < 3) {
            return "Reprovado";
        } elseif ($media < 6) {
            return "Recuperação";
        } else {
            return "Aprovado";
        }
    }

    private string $nome;
    public function setNome(string $novoN):void{
        $this->nome=$novoN;
    }
    public function getNome(): string{
        return $this->nome;
    }

    private float $nota1;
    public function setNota1(float $novaN1):void{
        if ($novaN1 < 0 || $novaN1 > 10) {
            throw new \InvalidArgumentException(
                'A nota deve ser entre 0 e 10!!!'
            );
        }
        $this->nota1 = $novaN1;
    }
    public function getNota1(): float{
        return $this->nota1;
    }

    private float $nota2;
    public function setNota2(float $novaN2):void{
        if ($novaN2 < 0 || $novaN2 > 10) {
            throw new \InvalidArgumentException(
                'A nota deve ser entre 0 e 10!!!'
            );
        }
        $this->nota2 = $novaN2;
    }
    public function getNota2(): float{
        return $this->nota2;
    }
}