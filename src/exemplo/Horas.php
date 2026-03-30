<?php
declare(strict_types=1);
namespace src\exemplo;
class Horas{
    private int $horas;
    public function setHoras(int $novaH):void{
        if ($novaH <= 0) {
            throw new \InvalidArgumentException(
                'A hora não pode ser negativa.'
            );
        }
        $this->horas = $novaH;
    }
    public function getHoras(): int{
        return $this->horas;

    }
    public function calcularMinutos():int{

        $calculo = $this->horas * 60;
        return $calculo;
    }

}