<?php

require __DIR__ . '/../vendor/autoload.php';



use src\projeto\Pessoa;
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


        $link1 = "<a href='formularioPessoa.html'> Cálculo de IMC</a>";

        $link3 = "<a href='formularioNota.html'> Cálculo de Média - Ver situação do aluno</a>";
        $link4 = "<a href='formularioFuncionario.html'> Salário de funcionário</a>";
        $link5 = "<a href='formularioTriangulo.html'> Calcular Triângulo</a>";


        $resposta = "<br>$link1<br>$link3<br>$link4<br>$link5";
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