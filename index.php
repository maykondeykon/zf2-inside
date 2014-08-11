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
// $di->instanceManager()->setParameters('SON\Db\Connection', array(
//     'server' => 'localhost',
//     'dbname' => 'banco',
//     'user' => 'username',
//     'password' => 123
// ));


//Cria um apelido para a classe de conexão e passa os parâmetros para a mesma
$di->instanceManager()->addAlias('conexao1', 'SON\Db\Connection', array(
    'server' => 'localho bst',
    'dbname' => 'banco',
    'user' => 'username',
    'password' => 123
));
//Instância outra classe de conexão com outros parâmetros
$di->instanceManager()->addAlias('conexao2', 'SON\Db\Connection', array(
    'server' => 'localhost',
    'dbname' => 'banco2',
    'user' => 'username',
    'password' => 1234
));

// Cria um apelido para as classes SON\Produto e SON\Db\Connection
$di->instanceManager()->addAlias('Connection', 'SON\Db\Connection');
$di->instanceManager()->addAlias('Produto', 'SON\Produto');

// Instancia a classe produto
$produto = $di->get('Produto');

//Configura a conexão padrão para a classe Connection
$di->instanceManager()->addTypePreference('SON\Db\Connection', 'conexao1');

//Instancia a classe categoria passando o parâmetro do banco de dados, sobrescreve a conexão preferêcial
// $categoria = $di->get('SON\Categoria',array('db'=>'conexao2'));


//Aqui ele usa a conexão padrão
$categoria = $di->get('SON\Categoria');

// Cria uma cópia de produto e checa se são o mesmo objeto
// $produto2 = $di->get('SON\Produto');
// echo $produto === $produto2;

// Exibe os dados carregados no Zend\Di --o @ exclui os 'Notices' da mensagem
// @Zend\Di\Display\Console::export($di);

print_r($categoria);



//Cria uma conexão com o banco de dados
// $conexao = new SON\Db\Connection('localhost','banco', 'root', 'password');

//Cria uma instância de Categoria
//Injeta a dependência conexão na classe categoria
// $categoria = new SON\Categoria($conexao);

// $produto =  new \SON\Produto();
// $produto->setId(1);
// $produto->setNome('Produto 1');
