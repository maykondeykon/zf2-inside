<?php
// Carrega o autoloader do Zend
require_once 'library/Zend/Loader/StandardAutoloader.php';

// Cria uma instância do autoloader
$loader = new Zend\loader\StandardAutoloader(array(
    'autoregister_zf' => true
));

// Registra um namespace no autoloader
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

// Configura as listas de definição para o Zend\Di
$definitionList = new Zend\Di\DefinitionList(array(
    // usa o arquivo criado por geraDefinicao.php, podem ser várias
    new Zend\Di\Definition\ArrayDefinition(include __DIR__ . '/data/di/SON-definition.php'),
    // Configura a definição em tempo real para as classes não mapeadas na lista acima
    new Zend\Di\Definition\RuntimeDefinition()
));

// Cria uma instância do Dependecy Injection e insere a lista definida
$di = new Zend\Di\Di($definitionList);

// Adiciona parâmetros para serem usados quando determinada classe for instanciada
$di->instanceManager()->setParameters('SON\Db\Connection', array(
    'server' => 'localhost',
    'dbname' => 'banco',
    'user' => 'username',
    'password' => 123
));

// Instancia as classes produto e categoria
$produto = $di->get('SON\Produto');
$categoria = $di->get('SON\Categoria');

// Cria uma cópia de produto e checa se são o mesmo objeto
// $produto2 = $di->get('SON\Produto');
// echo $produto === $produto2;

// Exibe os dados carregados no Zend\Di --o @ exclui os 'Notices' da mensagem
@Zend\Di\Display\Console::export($di);



//Cria uma conexão com o banco de dados
// $conexao = new SON\Db\Connection('localhost','banco', 'root', 'password');

//Cria uma instância de Categoria
//Injeta a dependência conexão na classe categoria
// $categoria = new SON\Categoria($conexao);

// $produto =  new \SON\Produto();
// $produto->setId(1);
// $produto->setNome('Produto 1');
