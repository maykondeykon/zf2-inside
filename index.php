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

// Cria uma instância do Dependecy Injection
$di = new Zend\Di\Di();

//Adiciona parâmetros para serem usados quando determinada classe for instanciada
$di->instanceManager()->setParameters('SON\Db\Connection', array(
    'server' => 'localhost',
    'dbname' => 'banco',
    'user' => 'username',
    'password' => 123
));

$produto = $di->get('SON\Produto');
$categoria = $di->get('SON\Categoria');

// Cria uma cópia de produto e checa se são o mesmo objeto
// $produto2 = $di->get('SON\Produto');
// echo $produto === $produto2;

print_r($categoria);




//Cria uma conexão com o banco de dados
// $conexao = new SON\Db\Connection('localhost','banco', 'root', 'password');

//Cria uma instância de Categoria
//Injeta a dependência conexão na classe categoria
// $categoria = new SON\Categoria($conexao);

// $produto =  new \SON\Produto();
// $produto->setId(1);
// $produto->setNome('Produto 1');
