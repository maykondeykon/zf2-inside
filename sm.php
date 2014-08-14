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

//Instância o ServiceManager
$serviceManager =  new ServiceManager();

//Cria uma instância de Produto no ServiceManager
// $serviceManager->setService('Produto', new SON\Produto());

//Instância um produto
// $produto = $serviceManager->get('Produto');
// print_r($produto);

//Retorna a mesma instância do serviço
// $produto2 = $serviceManager->get('Produto');

// var_dump((spl_object_hash($produto)) === (spl_object_hash($produto2)));


$serviceManager->setInvokableClass('Produto', 'SON\Produto');
//Instância um produto sem precisar usar o 'new' -- evita o acoplamento
$produto = $serviceManager->get('Produto');
// print_r($produto);

// Retorna a mesma instância do serviço
$produto2 = $serviceManager->get('Produto');

var_dump((spl_object_hash($produto)) === (spl_object_hash($produto2)));
