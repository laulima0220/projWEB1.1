<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto PAW1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h1{text-align: center;}
        a.card:hover {
        background-color: #000000;
        border-color: #222222;
        }
        h5{text-align: center;}
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="min-height: 70vh; background-color: #07093d;">

  <div class="container">

      <h1 class="text-primary">Projeto PAW 1º Bimestre</h1>
      <h5 class="text-info">Página de projeto com 5 formulários!!</h5>


    <div class="row justify-content-center g-3">

      <div class="col-4">
        <a href="formularioPessoa.html" class="card text-decoration-none text-white p-3 h-100" style="background-color: #7b00bd">
          <div class="card-body">
            <h6 class="card-title">Cálculo de IMC</h6>
            <p class="card-text" style="font-size: 13px;">Informe seu peso e altura para calcular seu IMC e ver sua situação.</p>
          </div>
        </a>
      </div>

    <div class="col-4">
        <a href="formularioProduto.html" class="card text-decoration-none text-white p-3 h-100" style="background-color: #7b00bd">
        <div class="card-body">
            <h6 class="card-title">Ver estoque de loja</h6>
            <p class="card-text" style="font-size: 13px;">Cadastre produtos e gerencie o estoque.</p>
        </div>
        </a>
    </div>

    <div class="col-4">
        <a href="formularioNota.html" class="card text-decoration-none text-white p-3 h-100" style="background-color: #7b00bd">
        <div class="card-body">
            <h6 class="card-title">Cálculo de média</h6>
            <p class="card-text" style="font-size: 13px;">Calcule a média do aluno e veja a situação.</p>
        </div>
        </a>
    </div>

    <div class="col-4">
        <a href="formularioFuncionario.html" class="card text-decoration-none text-white p-3 h-100" style="background-color: #7b00bd">
        <div class="card-body">
            <h6 class="card-title">Salário de funcionário</h6>
            <p class="card-text" style="font-size: 13px;">Calcule o salário a partir das horas trabalhadas e das horas extras.</p>
        </div>
        </a>
    </div>

    <div class="col-4">
        <a href="formularioTriangulo.html" class="card text-decoration-none text-white p-3 h-100" style="background-color: #7b00bd">
        <div class="card-body">
            <h6 class="card-title">Calcular triângulo</h6>
            <p class="card-text" style="font-size: 13px;">Informe os lados e descubra o tipo, perímetro e área do triângulo.</p>
        </div>
        </a>
    </div>

    </div>
</body>


</html>

<?php

require __DIR__ . '/../vendor/autoload.php';



use src\projeto\Pessoa;
use src\projeto\Produto;
use src\projeto\Nota;
use src\projeto\Funcionario;
use src\projeto\Triangulo;




use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as ResponseInterface;


$app = AppFactory::create();


$app->get(
    '/',
    function (Request $request, Response $response): ResponseInterface {
        return $response;
    }
);




$app->get(
    '/pessoa/imc',
    function(Request $request, Response $response): ResponseInterface{
        $dados = $request->getQueryParams();
        $Nomeform = $dados["txtNome"] ?? "";
        $Pesoform=$dados["txtPeso"] ?? 0;
        $Alturaform=$dados["txtAltura"] ?? 0;

        if(!is_numeric($Pesoform)){
            $response->getBody()->write("!! Erro: O peso deve ser um número.");
            return $response;
        }

        if(!is_numeric($Alturaform)){
            $response->getBody()->write("!! Erro: A altura deve ser um número.");
            return $response;
        }

        $p = new Pessoa();
        $p->setNome($Nomeform);
        $p->setPeso($Pesoform);
        $p->setAltura($Alturaform);
        $imc = $p->calcularIMC();
        $mensagem = $p->MensagemIMC();
        $resposta = "Olá, $Nomeform!<br>Seu IMC é $imc<br>Situação: $mensagem";
        $response->getBody()->write($resposta);
        return $response;
    }
);

$app->get(
    '/produtos/estoques',
    function(Request $request, Response $response): ResponseInterface{
        $dados = $request->getQueryParams();
        $produtosform = [];

        for ($i = 1; $i <= 5; $i++) {
            $nomeform = $dados["txtNome$i"] ?? "";
            $precoform = str_replace(',', '.', $dados["txtPreco$i"] ?? 0);
            $estoqueform = $dados["txtQtdE$i"] ?? 0;
            $entradaform = $dados["txtAddE$i"] ?? 0;
            $saidaform = $dados["txtDelE$i"] ?? 0;
   
            if (!is_numeric($precoform) || !is_numeric($entradaform) || !is_numeric($saidaform)) {
                $response->getBody()->write("Erro no produto $i: valores inválidos");
                return $response;
            }

            $p=new Produto();
            $p->setNome($nomeform);
            $p->setPreco($precoform);
            $p->setEstoque($estoqueform);
            $p->addEstoque($entradaform);
            $p->delEstoque($saidaform);

            $produtosform[]=$p;
        }

    $resposta = "";

    foreach ($produtosform as $p) {
        $resposta .= "Produto: " . $p->getNome() . "<br>";
        $resposta .= "Quantidade: " . $p->getEstoque() . "<br>";
        $resposta .= "Valor total: R$ " . number_format($p->getValorTotal(), 2, ',', '.') . "<br><br>";
    }

    $response->getBody()->write($resposta);
    return $response;
    }
);

$app->get(
    '/notas/situacoes', 
    function(Request $request, Response $response): ResponseInterface{
        $dados = $request->getQueryParams();
        $Nomeform = $dados["txtNome"] ?? "";
        $Nota1form=$dados["txtNota1"] ?? 0;
        $Nota2form=$dados["txtNota2"] ?? 0;

        if(!is_numeric($Nota1form)){
            $response->getBody()->write("!! Erro: A Nota deve ser um número.");
            return $response;
        }

        if(!is_numeric($Nota2form)){
            $response->getBody()->write("!! Erro: A Nota deve ser um número.");
            return $response;
        }

        $n=new Nota();
        $n->setNome($Nomeform);
        $n->setNota1($Nota1form);
        $n->setNota2($Nota2form);
        $media=$n->CalcularMedia();
        $situacao=$n->SituacaoAluno();

        $resposta = "Olá, $Nomeform!<br>Nota 1: $Nota1form || Nota 2: $Nota2form<br>Média: $media<br>Situação: $situacao";
        $response->getBody()->write($resposta);
        return $response;
    }
);

$app->get(
    '/funcionarios/salarios',
    function(Request $request, Response $response): ResponseInterface{
        $dados=$request->getQueryParams();
        $Nomeform=$dados["txtNome"] ?? "";
        $valorHoraform=$dados["txtvalorHora"] ?? 0;
        $valorHoraExtraform=$dados["txtvalorHoraExtra"] ?? 0;
        $qtdHorasform=$dados["txtqtdHoras"] ?? 0;
        $qtdHorasExtrasform=$dados["txtqtdHorasExtras"] ?? 0;

        if(!is_numeric($valorHoraform)){
            $response->getBody()->write("!! Erro: O valor da hora deve ser um número.");
            return $response;
        }

        
        if(!is_numeric($valorHoraExtraform)){
            $response->getBody()->write("!! Erro: O valor da hora extra deve ser um número.");
            return $response;
        }

        if(!is_numeric($qtdHorasform)){
            $response->getBody()->write("!! Erro: A quantidade de horas deve ser um número.");
            return $response;
        }

        if(!is_numeric($qtdHorasExtrasform)){
            $response->getBody()->write("!! Erro: A quantidade de horas extras deve ser um número.");
            return $response;
        }

        $f=new Funcionario();
        $f->setNome($Nomeform);
        $f->setvalorHora($valorHoraform);
        $f->setvalorHoraExtra($valorHoraExtraform);
        $f->setqtdHoras($qtdHorasform);
        $f->setqtdHorasExtras($qtdHorasExtrasform);
        $salario=$f->calcularSalario();
        $resposta = "Olá $Nomeform!<br>Seu salário é $salario";
        $response->getBody()->write($resposta);
        return $response;
    }
);

$app->get(
    '/triangulos/perimetros',
    function(Request $request, Response $response): ResponseInterface{
        $dados=$request->getQueryParams();
        $LadoAform=$dados["txtLadoA"] ?? 0;
        $LadoBform=$dados["txtLadoB"] ?? 0;
        $LadoCform=$dados["txtLadoC"] ?? 0;

        if(!is_numeric($LadoAform)){
            $response->getBody()->write("!! Erro: O lado deve ser um número.");
            return $response;
        }
        if(!is_numeric($LadoBform)){
            $response->getBody()->write("!! Erro: O lado deve ser um número.");
            return $response;
        }
        if(!is_numeric($LadoCform)){
            $response->getBody()->write("!! Erro: O lado deve ser um número.");
            return $response;
        }

        $l=new Triangulo();
        $l->setLadoA($LadoAform);
        $l->setLadoB($LadoBform);
        $l->setLadoC($LadoCform);
        $l->testarTriangulo();
        $tipo=$l->tipoTriangulo();
        $perimetro=$l->calcularPerimetro();
        $area=$l->calcularArea();
        $resposta="Tipo do triângulo: $tipo<br>Perímetro: $perimetro<br>Área: $area";
        $response->getBody()->write($resposta);
        return $response;
    }
);



$app->run();


?>