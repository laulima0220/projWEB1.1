<?php
/**
 * ============================================
 * 🎯 FRONT CONTROLLER - PONTO DE ENTRADA DA APLICAÇÃO
 * ============================================
 * 
 * O que é um Front Controller?
 * - É um padrão de design onde todas as requisições passam por um único arquivo
 * - Funciona como uma "portaria" que direciona cada requisição para o local correto
 * - Facilita a manutenção e centraliza configurações
 * 
 * Este arquivo é o coração da nossa API!
 * 
 * Fluxo de uma requisição:
 * 1. Usuário acessa uma URL (ex: /quadrados/areas?txtLado=5)
 * 2. O servidor web redireciona para este arquivo (index.php)
 * 3. O Slim analisa a URL e encontra a rota correspondente
 * 4. Executa a função associada à rota
 * 5. Retorna a resposta para o usuário
 */

// ============================================
// 📦 CARREGAMENTO INICIAL
// ============================================

/**
 * require __DIR__ . '/../vendor/autoload.php'
 * 
 * O que é autoload?
 * - Sem autoload, precisaríamos fazer vários "require" manuais
 * - Exemplo antigo: require_once 'src/geometria/Quadrado.php'
 * - O Composer cria automaticamente um arquivo que carrega todas as classes necessárias
 * 
 * __DIR__ é uma constante mágica do PHP que retorna o diretório atual do arquivo
 * /../ significa "voltar uma pasta" (sai de /public e vai para a raiz do projeto)
 */
require __DIR__ . '/../vendor/autoload.php';

// ============================================
// 📚 IMPORTAÇÃO DE CLASSES (USE STATEMENTS)
// ============================================

/**
 * Namespace 'src\geometria'
 * 
 * Organização do código:
 * - src/geometria/Quadrado.php → classe Quadrado
 * - src/geometria/Retangulo.php → classe Retangulo
 * 
 * Por que usar namespaces?
 * - Evita conflito de nomes (duas classes com mesmo nome)
 * - Organiza o código em módulos
 * - Facilita a localização dos arquivos
 */
use src\geometria\Quadrado;
use src\geometria\Retangulo;
use src\exemplo\Horas;
use src\projeto\Pessoa;

/**
 * Classes do Slim Framework:
 * 
 * AppFactory: Fábrica que cria instâncias da aplicação Slim
 * Request: Representa a requisição HTTP (dados que chegam)
 * Response: Representa a resposta HTTP (dados que saem)
 * ResponseInterface: Contrato que toda resposta deve seguir
 */
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as ResponseInterface;

/**
 * 🤔 O que é PSR?
 * - PSR = PHP Standards Recommendation (Recomendações de Padrões PHP)
 * - PSR-7: Padrão para interfaces de mensagens HTTP
 * - Usar padrões garante que bibliotecas diferentes possam trabalhar juntas
 */

// ============================================
// 🚀 INICIALIZAÇÃO DO SLIM
// ============================================

/**
 * AppFactory::create()
 * 
 * Cria uma nova instância da aplicação Slim
 * 
 * Analogia:
 * - É como ligar um computador e abrir o sistema operacional
 * - A partir de agora, o sistema está pronto para receber comandos
 */
$app = AppFactory::create();

// ============================================
// 🏠 ROTA PRINCIPAL (HOME)
// ============================================

/**
 * $app->get('/', ...)
 * 
 * O que é uma rota?
 * - É uma associação entre uma URL e uma função
 * - Define "se o usuário acessar X, execute Y"
 * 
 * Método HTTP GET:
 * - Usado para buscar/ler informações
 * - Dados visíveis na URL (via query string)
 * - Ideal para consultas e navegação
 * 
 * Parâmetros:
 * 1. '/' → Caminho da URL (raiz do site)
 * 2. Função callback → O que fazer quando acessarem esta rota
 * 
 * Exemplos de acesso:
 * - http://localhost:8000/ (entra aqui)
 * - http://meusite.com/ (entra aqui)
 */
$app->get(
    '/',
    /**
     * Função anônima (closure)
     * 
     * Recebe dois parâmetros automáticos do Slim:
     * @param Request $request  - Contém dados da requisição (cookies, parâmetros, headers)
     * @param Response $response - Objeto para construir a resposta
     * 
     * @return ResponseInterface - Deve retornar um objeto Response válido
     */
    function (Request $request, Response $response): ResponseInterface {

        /**
         * Links HTML para navegação
         * 
         * <a href='...'>...</a> é a tag de link do HTML
         * href define o destino do link (URL relativa)
         * 
         * Como o navegador processa:
         * 1. Usuário clica no link
         * 2. Navegador faz uma requisição GET para a URL
         * 3. Slim procura uma rota que corresponde à URL
         */
        $link1 = "<a href='formularioQuadrado.html'>🔲 Exemplo Quadrado</a>";
        $link2 = "<a href='formularioRetangulo.html'>📏 Exemplo Retângulo</a>";
        $link3 = "<a href='formularioHoras.html'>📏 Exemplo Horas</a>";
        $link4 = "<a href='formularioPessoa.html'>📏 Cálculo de IMC</a>";

        /**
         * Construção da resposta:
         * 
         * getBody(): Obtém o "corpo" da resposta (onde colocamos o conteúdo)
         * write(): Escreve conteúdo no corpo (aceita string)
         * 
         * ⚠️ IMPORTANTE: Em APIs profissionais, NÃO se deve retornar HTML
         * O correto seria retornar JSON (falaremos sobre isso depois)
         */
        $resposta = "$link1<br>$link2<br>$link3<br>$link4";
        $response->getBody()->write($resposta);

        /**
         * Sempre retornar o objeto Response
         * Isso permite que o Slim adicione headers HTTP e finalize a resposta
         */
        return $response;
    }
);

// ============================================
// 📐 ROTAS PARA QUADRADO
// ============================================

/**
 * Rota: /quadrados/areas
 * 
 * Convenção de nomenclatura RESTful:
 * - Usar substantivos no plural (quadrados, não quadrado)
 * - /quadrados/areas → "áreas de quadrados"
 * - /quadrados/perimetros → "perímetros de quadrados"
 * 
 * @see https://restfulapi.net/resource-naming/
 */
$app->get(
    '/quadrados/areas',
    function (Request $request, Response $response): ResponseInterface {

        /**
         * $request->getQueryParams()
         * 
         * Obtém parâmetros da query string (URL)
         * 
         * Exemplo: /quadrados/areas?txtLado=5
         * Resultado: ['txtLado' => '5']
         * 
         * Query String = parte após ? na URL
         * Formato: chave=valor&outraChave=outroValor
         */
        $dados = $request->getQueryParams();

        /**
         * Operador ?? (Null coalescing)
         * 
         * Funciona como: "se existir, usa o valor; senão, usa 0"
         * 
         * Exemplo 1: /quadrados/areas?txtLado=5
         * $dados["txtLado"] existe? Sim → $lado = 5
         * 
         * Exemplo 2: /quadrados/areas
         * $dados["txtLado"] existe? Não → $lado = 0
         * 
         * Isso evita erros "Undefined array key"
         */
        $lado = $dados["txtLado"] ?? 0;

        /**
         * Validação de dados
         * 
         * is_numeric() verifica se o valor é um número
         * 
         * Por que validar?
         * - Segurança: impede injeção de código
         * - Consistência: operações matemáticas precisam de números
         * - Experiência do usuário: mensagem de erro clara
         */
        if (!is_numeric($lado)) {
            $response->getBody()->write("❌ Erro: O lado deve ser um número");
            return $response;
        }

        /**
         * Programação Orientada a Objetos (POO)
         * 
         * 1. Instanciamos um objeto da classe Quadrado (criamos um quadrado na memória)
         * 2. Configuramos suas propriedades com setLado()
         * 3. Pedimos para ele calcular sua área com calcularArea()
         * 
         * Vantagens da POO:
         * - Organização: cada classe tem sua responsabilidade
         * - Reutilização: podemos criar vários quadrados
         * - Manutenção: se mudar fórmula da área, muda só na classe
         */
        $quadrado = new Quadrado();
        $quadrado->setLado($lado);

        /**
         * O objeto Quadrado agora tem:
         * - Propriedade $lado = valor informado
         * - Método calcularArea() que retorna lado * lado
         */
        $area = $quadrado->calcularArea();

        /**
         * Interpolação de strings
         * 
         * Strings com aspas duplas permitem colocar variáveis dentro
         * Exemplo: "area = $area" vira "area = 25"
         */
        $resultado = "📐 Área do quadrado = $area";
        $response->getBody()->write($resultado);

        return $response;
    }
);

/**
 * Rota para perímetro do quadrado
 * 
 * Similar à rota de área, mas chama método diferente
 * 
 * Princípio DRY (Don't Repeat Yourself):
 * - Note que o código é muito parecido com a rota de área
 * - Em código mais avançado, poderíamos refatorar para evitar repetição
 */
$app->get(
    '/quadrados/perimetros',
    function (Request $request, Response $response): ResponseInterface {

        $dados = $request->getQueryParams();
        $lado = $dados["txtLado"] ?? 0;

        if (!is_numeric($lado)) {
            $response->getBody()->write("❌ Erro: O lado deve ser um número");
            return $response;
        }

        $quadrado = new Quadrado();
        $quadrado->setLado($lado);

        /**
         * Perímetro = soma de todos os lados
         * Como é um quadrado: 4 * lado
         */
        $perimetro = $quadrado->calcularPerimetro();

        $resultado = "📏 Perímetro do quadrado = $perimetro";
        $response->getBody()->write($resultado);

        return $response;
    }
);

// ============================================
// 📏 ROTAS PARA RETÂNGULO
// ============================================

/**
 * Rota para perímetro do retângulo
 * 
 * Diferença do quadrado:
 * - Retângulo precisa de base E altura
 * - Quadrado só precisa do lado
 */
$app->get(
    '/retangulos/perimetros',
    function (Request $request, Response $response): ResponseInterface {

        /**
         * Múltiplos parâmetros
         * 
         * Exemplo: /retangulos/perimetros?txtBase=5&txtAltura=3
         * - txtBase=5 (base = 5)
         * - txtAltura=3 (altura = 3)
         */
        $dados = $request->getQueryParams();
        $base = $dados["txtBase"] ?? 0;
        $altura = $dados["txtAltura"] ?? 0;

        /**
         * Validação individual
         * 
         * Validamos cada parâmetro separadamente para dar mensagens específicas
         * Isso ajuda o usuário a entender qual dado está errado
         */
        if (!is_numeric($base)) {
            $response->getBody()->write("❌ Erro: A base deve ser um número");
            return $response;
        }

        if (!is_numeric($altura)) {
            $response->getBody()->write("❌ Erro: A altura deve ser um número");
            return $response;
        }

        /**
         * Criando retângulo
         * 
         * Diferente do quadrado, retângulo precisa configurar duas propriedades
         * A ordem não importa, desde que ambas sejam configuradas
         */
        $r1 = new Retangulo();
        $r1->setBase($base);
        $r1->setAltura($altura);

        /**
         * Fórmula do perímetro do retângulo: 2 * (base + altura)
         * O método calcularPerimetro() encapsula esta lógica
         */
        $perimetro = $r1->calcularPerimetro();

        $resultado = "📏 Perímetro do retângulo = $perimetro";
        $response->getBody()->write($resultado);

        return $response;
    }
);

/**
 * Rota para área do retângulo
 * 
 * ⚠️ ATENÇÃO: Esta rota contém um erro didático!
 * 
 * O que está errado?
 * - A variável $resultado escreve "perimetros = $area"
 * - Deveria ser "area = $area"
 * 
 * Por que isso é interessante?
 * - Mostra a importância de revisar o código
 * - Demonstra como erros de digitação podem passar despercebidos
 * - Exercício: Encontre e corrija o erro!
 */
$app->get(
    '/retangulos/areas',
    function (Request $request, Response $response): ResponseInterface {

        $dados = $request->getQueryParams();
        $base = $dados["txtBase"] ?? 0;
        $altura = $dados["txtAltura"] ?? 0;

        if (!is_numeric($base)) {
            $response->getBody()->write("❌ Erro: A base deve ser um número");
            return $response;
        }

        if (!is_numeric($altura)) {
            $response->getBody()->write("❌ Erro: A altura deve ser um número");
            return $response;
        }

        $r1 = new Retangulo();
        $r1->setBase($base);
        $r1->setAltura($altura);

        /**
         * Fórmula da área do retângulo: base * altura
         */
        $area = $r1->calcularArea();

        /**
         * 🐛 ERRO DIDÁTICO AQUI!
         * 
         * A mensagem diz "perimetros" mas estamos calculando área
         * Isso confundirá o usuário
         * 
         * Correção sugerida:
         * $resultado = "📐 Área do retângulo = $area";
         */
        $resultado = "perimetros = $area";
        $response->getBody()->write($resultado);

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
        $resposta = "Olá, $Nomeform! Seu IMC é $imc - $mensagem";
        $response->getBody()->write($resposta);
        return $response;
    }
);

// ============================================
// ▶️ EXECUÇÃO DA APLICAÇÃO
// ============================================

/**
 * $app->run()
 * 
 * O que acontece aqui?
 * 1. Slim analisa a URL requisitada
 * 2. Compara com todas as rotas definidas
 * 3. Se encontrar correspondência, executa a função
 * 4. Se não encontrar, retorna erro 404
 * 5. Envia a resposta para o navegador
 * 
 * Este método DEVE ser o último no arquivo
 * Nada depois dele será executado (na prática)
 */
$app->run();

/**
 * ============================================
 * 📚 RESUMO DOS CONCEITOS APRENDIDOS
 * ============================================
 * 
 * 1. Front Controller: Ponto único de entrada
 * 2. Autoload: Carregamento automático de classes
 * 3. Namespaces: Organização de código
 * 4. Rotas: Associação URL → função
 * 5. Métodos HTTP: GET para consultas
 * 6. Request: Dados que chegam
 * 7. Response: Dados que saem
 * 8. Query Parameters: Dados na URL (?chave=valor)
 * 9. Validação: Verificar dados antes de usar
 * 10. POO: Objetos com propriedades e métodos
 * 11. Interpolação: Variáveis dentro de strings
 * 
 * 📝 EXERCÍCIOS SUGERIDOS:
 * 
 * 1. Corrija o erro na rota /retangulos/areas
 * 2. Adicione validação para números negativos
 * 3. Crie uma rota para calcular diagonal do retângulo
 * 4. Altere as respostas para formato JSON
 * 5. Adicione uma rota com método POST
 * 6. Crie uma classe Triangulo com suas rotas
 */
?>