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

$exemplo = new SON\Event\Exemplo();

//Cria um listener para a trigger metodo
$exemplo->getEventManager()->attach('metodo',function ($e){
   echo $e->getName()."\n" ;    // Pega o nome do evento
   echo get_class($e->getTarget())."\n" ;   //Pega o nome da classe
   echo $e->getParam('valor')."\n";
});

$exemplo->metodo(20);

