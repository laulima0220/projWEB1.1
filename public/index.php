<?php

require __DIR__ . '/../vendor/autoload.php';


use src\geometria\Quadrado;
use src\geometria\Retangulo;
use src\exemplo\Horas;
use src\projeto\Pessoa;

use src\projeto\Nota;


use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as ResponseInterface;


$app = AppFactory::create();


$app->get(
    '/',

    function (Request $request, Response $response): ResponseInterface {


        $link1 = "<a href='formularioPessoa.html'>📏 Cálculo de IMC</a>";


        $resposta = "<br>$link1";
        $response->getBody()->write($resposta);



        return $response;
    }
);


$app->get(
    '/horas/minutos',
    function (Request $request, Response $response): ResponseInterface {

        $dados = $request->getQueryParams();
        $HorasveioDoFormulario = $dados["txtHoras"] ?? 0;
      

        if (!is_numeric($HorasveioDoFormulario)) {
            $response->getBody()->write("❌ Erro: A Hora deve ser um número");
            return $response;
        }

        $h = new Horas();
        $h->setHoras($HorasveioDoFormulario);
        $calculo = $h->calcularMinutos();
        $resposta = "$HorasveioDoFormulario horas são $calculo minutos";

       
        $response->getBody()->write($resposta);

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



$app->run();


?>