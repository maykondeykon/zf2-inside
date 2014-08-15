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

use Zend\ServiceManager\ServiceManager;

// Instância o ServiceManager
$serviceManager = new ServiceManager();

// Cria uma instância de Produto no ServiceManager
// $serviceManager->setService('Produto', new SON\Produto());

// Instância um produto
// $produto = $serviceManager->get('Produto');
// print_r($produto);

// Retorna a mesma instância do serviço
// $produto2 = $serviceManager->get('Produto');

// var_dump((spl_object_hash($produto)) === (spl_object_hash($produto2)));

// InvokableClass
// $serviceManager->setInvokableClass('Produto', 'SON\Produto');
// Instância um produto sem precisar usar o 'new' -- evita o acoplamento
// $produto = $serviceManager->get('Produto');
// print_r($produto);

// Retorna a mesma instância do serviço
// $produto2 = $serviceManager->get('Produto');

// var_dump((spl_object_hash($produto)) === (spl_object_hash($produto2)));

// Factories

//Cria o serviço Connection
// $serviceManager->setService('Connection', new SON\Db\Connection('a', 'b', 'c', 'd'));

// Configura a fabricação do objeto Categoria
// $serviceManager->setFactory('Categoria', function ($sm)
// {
//     $connection = $sm->get('Connection');    //Recupera uma instância de Connection
//     $categoria = new \SON\Categoria($connection);
//     $categoria = new \SON\Categoria($sm->get('Connection')); //Carrega a conexão direto
//     return $categoria;
//     return new \SON\Categoria($sm->get('Connection'));
// });

// Instância Categoria com todas as dependências satisfeitas
// $categoria = $serviceManager->get('Categoria');
// print_r($categoria);

// $serviceManager->setFactory('Categoria','SON\CategoriaFactory');
// // Instância Categoria com todas as dependências satisfeitas
// $categoria = $serviceManager->get('Categoria');
// print_r($categoria);

// Alias

// $serviceManager->setService('SON\Db\Connection', new SON\Db\Connection('a', 'b', 'c', 'd'));
// $serviceManager->setAlias('Connection', 'SON\Db\Connection');

// print_r($serviceManager->get('Connection'));

// SharedManager

$serviceManager->setInvokableClass('Produto', 'SON\Produto');
$serviceManager->setShared('Produto', false);
$produto = $serviceManager->get('Produto');
$produto2 = $serviceManager->get('Produto');
var_dump((spl_object_hash($produto)) === (spl_object_hash($produto2)));
