<?php

require __DIR__ . '/../vendor/autoload.php';



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
        $link2 = "<a href='formularioNota.html'> Cálculo de Média - Ver situação do aluno</a>";


        $resposta = "<br>$link1<br>$link2";
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


$app->run();


?>