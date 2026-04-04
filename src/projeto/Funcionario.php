<?php
declare(strict_types=1);
namespace src\projeto;

class Funcionario{

    public function calcularSalario(){
        return $this->valorHora * $this->qtdHoras + $this->valorHoraExtra * $this->qtdHorasExtras;
    }

    private string $nome;
    public function setNome(string $novoN):void{    
        $this->nome=$novoN;
    }
    public function getNome(): string{
        return $this->nome;
    }

    public float $valorHora;
    public function setvalorHora(float $novoVH):void{
        if($novoVH<=0){
            throw new \InvalidArgumentException(
                'O valor da hora não pode ser negativo!!!'
            );
        }
        $this->valorHora=$novoVH;
    }
    public function getvalorHora():float{
        return $this->valorHora;
    }

    public float $valorHoraExtra;
    public function setvalorHoraExtra(float $novoVHE):void{
        if($novoVHE<=0){
            throw new \InvalidArgumentException(
                'O valor da hora extra não pode ser negativo!!!'
            );
        }
        $this->valorHoraExtra=$novoVHE;
    }
    public function getvalorHoraExtra():float{
        return $this->valorHoraExtra;
    }

    public float $qtdHoras;
    public function setqtdHoras(float $novoQH):void{
        if($novoQH<=0){
            throw new \InvalidArgumentException(
                'A quantidade de horas não pode ser negativa!!!'
            );
        }
        $this->qtdHoras=$novoQH;
    }
    public function getqtdHoras():float{
        return $this->qtdHoras;
    }

    public float $qtdHorasExtras;
    public function setqtdHorasExtras(float $novoQHE):void{
        if($novoQHE<=0){
            throw new \InvalidArgumentException(
                'A quantidade de horas extras não pode ser negativa!!!'
            );
        }
        $this->qtdHorasExtras=$novoQHE;
    }
    public function getqtdHorasExtras():float{
        return $this->qtdHorasExtras;
    }
}