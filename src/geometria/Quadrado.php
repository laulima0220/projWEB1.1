<?php
/**
 * Ativa tipagem estrita neste arquivo.
 *
 * Com strict_types=1, o PHP NÃO faz conversão automática
 * de tipos escalares (int, float, string, bool).
 *
 * Exemplo:
 * new Quadrado("5"); // Gera TypeError
 *
 * Sem strict_types, o PHP converteria "5" para 5 automaticamente.
 */
declare(strict_types=1);

/**
 * Namespace responsável por armazenar as classes
 * de modelo (entidades de domínio) da aplicação.
 *
 * Estrutura baseada no padrão PSR-4.
 *
 * @package src\geometria
 */
namespace src\geometria;

/**
 * Classe Quadrado
 *
 * Representa um quadrado geométrico e fornece
 * métodos para cálculo de área, perímetro e diagonal.
 *
 * @package src\geometria
 */
class Quadrado
{
    /**
     * Comprimento do lado do quadrado.
     *
     * Este atributo armazena o valor do lado utilizado
     * nos cálculos de área, perímetro e diagonal.
     *
     * @var float
     */
    private float $lado;
    /**
     * Construtor da classe
     * 
     * 💡 Didático:
     * Poderíamos receber o lado, mas foi deixado vazio
     * para demonstrar o uso de setters.
     */
    public function __construct()
    {
    }

    /**
     * Calcula a área do quadrado.
     *
     * Fórmula:
     * área = lado²
     *
     * @return float Área calculada.
     */
    public function calcularArea(): float
    {
        return $this->lado * $this->lado;
    }

    /**
     * Calcula o perímetro do quadrado.
     *
     * Fórmula:
     * perímetro = 4 × lado
     *
     * @return float Perímetro calculado.
     */
    public function calcularPerimetro(): float
    {
        return 4 * $this->lado;
    }

    /**
     * Calcula a diagonal do quadrado.
     *
     * Fórmula:
     * diagonal = lado × √2
     *
     * @return float Diagonal calculada.
     */
    public function calcularDiagonal(): float
    {
        return $this->lado * sqrt(2);
    }

    /**
     * Define um novo valor para o lado do quadrado.
     *
     * @param float $novoLado Novo valor do lado.
     * @return void
     */
    public function setLado(float $novoLado): void
    {
        if ($novoLado <= 0) {
            throw new \InvalidArgumentException(
                'O lado do quadrado não pode ser negativo.'
            );
        }
        $this->lado = $novoLado;
    }

    /**
     * Retorna o valor atual do lado do quadrado.
     *
     * @return float Valor do lado.
     */
    public function getLado(): float
    {
        return $this->lado;
    }
}