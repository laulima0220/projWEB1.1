<?php
declare(strict_types=1);
namespace src\projeto;

class Triangulo{


    public function testarTriangulo():void{
        if (
        $this->ladoA + $this->ladoB <= $this->ladoC ||
        $this->ladoA + $this->ladoC <= $this->ladoB ||
        $this->ladoB + $this->ladoC <= $this->ladoA
        ) {
        throw new \InvalidArgumentException("Triângulo não existe!");
        }
    }  

    public function tipoTriangulo():string{
        $this->testarTriangulo();
        if($this->ladoA==$this->ladoB && $this->ladoB==$this->ladoC){
            return "Equilátero";
        } elseif ($this->ladoA==$this->ladoB || $this->ladoB==$this->ladoC || $this->ladoA==$this->ladoC){
            return "Isóceles";
        }else{
            return "Escaleno";
        }
    }

    public function calcularArea():float{
        $this->testarTriangulo();
        $p=($this->ladoA + $this->ladoB + $this->ladoC)/2;
        return sqrt($p*($p-$this->ladoA)*($p-$this->ladoB)*($p-$this->ladoC));
    }

    public function calcularPerimetro():float{
        $this->testarTriangulo();
        return $this->ladoA + $this->ladoB + $this->ladoC;
    }

    private float $ladoA;
    public function setLadoA(float $novoL):void{
        if($novoL<=0){
            throw new \InvalidArgumentException(
                'O lado não pode ser negativo!!!'
            );
        }
        $this->ladoA=$novoL;
    }
    public function getLadoA(): float{
        return $this->ladoA;
    }

    private float $ladoB;
    public function setLadoB(float $novoL):void{
        if($novoL<=0){
            throw new \InvalidArgumentException(
                'O lado não pode ser negativo!!!'
            );
        }
        $this->ladoB=$novoL;
    }
    public function getLadoB(): float{
        return $this->ladoB;
    }

    private float $ladoC;
    public function setLadoC(float $novoL):void{
        if($novoL<=0){
            throw new \InvalidArgumentException(
                'O lado não pode ser negativo!!!'
            );
        }
        $this->ladoC=$novoL;
    }
    public function getLadoC(): float{
        return $this->ladoC;
    }
}