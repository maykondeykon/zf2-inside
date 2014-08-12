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
// 'server' => 'localhost',
// 'dbname' => 'banco',
// 'user' => 'username',
// 'password' => 123
// ));

// Cria um apelido para a classe de conexão e passa os parâmetros para a mesma
$di->instanceManager()->addAlias('conexao1', 'SON\Db\Connection', array(
    'server' => 'localhost',
    'dbname' => 'banco',
    'user' => 'username',
    'password' => 123
));
// Instância outra classe de conexão com outros parâmetros
$di->instanceManager()->addAlias('conexao2', 'SON\Db\Connection', array(
    'server' => 'localhost',
    'dbname' => 'banco2',
    'user' => 'username',
    'password' => 1234
));

$di->instanceManager()->addTypePreference('SON\Db\Connection', 'conexao1');

// $categoria = $di->get('SON\Categoria', array(
// 'db' => 'conexao2'
// ));

// $di = new Zend\Di\Di();

// Configura as dependências do método setCategoria de SON\Produto
// $di->configure(new Zend\Di\Config(array(
// 'definition' => array(
// 'class' => array(
// 'SON\Produto' => array(
// 'setCategoria' => array(
// 'required' => true //Configura para sempre excutar esta configuração
// )
// )
// )
// )
// )));


//Configura várias dependências para a classe SON\Produto
$di->configure(new Zend\Di\Config(array(
    'definition' => array(
        'class' => array(
            'SON\Produto' => array(
                'addCategoria' => array(    //Informa o método
                    'categoria' => array(   //informa o nome da classe
                        'type' => 'SON\CategoriaInterface', //informa o tipo de classe
                        'required' => true
                    )
                )
            )
        )
    ),
    'instance' => array(    // Cria as instâncias e insere as dependências
        'SON\Produto' => array(
            'injections' => array(
                'SON\Categoria',
                'SON\Category'
            )
        )
    )
)));

$produto = $di->get('SON\Produto');
print_r($produto);

