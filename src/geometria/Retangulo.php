<?php
/**
 * Ativa tipagem estrita neste arquivo.
 *
 * Com strict_types=1, o PHP NÃO faz conversão automática
 * de tipos escalares (int, float, string, bool).
 *
 */
declare(strict_types=1);

namespace src\geometria;

/**
 * Classe que representa um Retângulo.
 * 
 * 📚 Conceitos importantes:
 * - Encapsulamento: atributos privados acessados via getters/setters
 * - Responsabilidade única: a classe só cuida de cálculos geométricos
 * - Uso de tipagem forte (float)
 */
class Retangulo
{
    /**
     * Base do retângulo
     * @var float
     */
    private float $base ;

    /**
     * Altura do retângulo
     * @var float
     */
    private float $altura;

    /**
     * Construtor da classe
     * 
     * 💡 Didático:
     * Poderíamos receber base e altura aqui, mas foi deixado vazio
     * para demonstrar o uso de setters.
     */
    public function __construct()
    {
    }

    /**
     * Calcula a área do retângulo
     * 
     * Fórmula: base × altura
     * 
     * @return float
     */
    public function calcularArea(): float
    {
        return $this->base * $this->altura;
    }

    /**
     * Calcula o perímetro do retângulo
     * 
     * Fórmula: 2 × (base + altura)
     * 
     * @return float
     */
    public function calcularPerimetro(): float
    {
        return 2 * ($this->base + $this->altura);
    }

    /**
     * Calcula a diagonal do retângulo
     * 
     * Fórmula baseada no Teorema de Pitágoras:
     * d = √(base² + altura²)
     * 
     * 💡 Didático:
     * Aqui usamos a função sqrt() e o operador de potência (**)
     * 
     * @return float
     */
    public function calcularDiagonal(): float
    {
        return sqrt(($this->base ** 2) + ($this->altura ** 2));
    }

    /**
     * Define a base do retângulo
     * 
     * 💡 Boa prática:
     * Poderíamos validar valores negativos aqui
     * 
     * @param float $novaBase
     */
    public function setBase(float $novaBase): void
    {
        if ($novaBase <= 0) {
            throw new \InvalidArgumentException(
                'A base do retangulo não pode ser negativa.'
            );
        }
        $this->base = $novaBase;
    }

    /**
     * Retorna a base do retângulo
     * 
     * @return float
     */
    public function getBase(): float
    {
        return $this->base;
    }

    /**
     * Define a altura do retângulo
     * 
     * 💡 Boa prática:
     * Ideal validar se altura >= 0
     * 
     * @param float $novaAltura
     */
    public function setAltura(float $novaAltura): void
    {

        if ($novaAltura <= 0) {
            throw new \InvalidArgumentException(
                'A altura do retangulo não pode ser negativa.'
            );
        }
        $this->altura = $novaAltura;
    }

    /**
     * Retorna a altura do retângulo
     * 
     * @return float
     */
    public function getAltura(): float
    {
        return $this->altura;
    }
}