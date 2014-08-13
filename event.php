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

// //Cria um listener para a trigger metodo
// $exemplo->getEventManager()->attach('metodo',function ($e){
// echo $e->getName()."\n" ; // Pega o nome do evento
// echo get_class($e->getTarget())."\n" ; //Pega o nome da classe
// echo $e->getParam('valor')."\n";
// });

//Instância um evento compartilhado
$events = new Zend\EventManager\SharedEventManager();
//Cria um novo listener para o método metodo na classe Exemplo
//parâmetros -- Classe, método, função a ser executada
// $events->attach('SON\Event\Exemplo', 'metodo', function ($e)
// {
//     echo $e->getName()."\n" ; // Pega o nome do evento
//     echo get_class($e->getTarget())."\n" ; //Pega o nome da classe
//     echo $e->getParam('valor')."\n";
// });

//Usa o mesmo attach para 2 métodos que usam a mesma função de callback
// $events->attach('SON\Event\Exemplo', array('metodo', 'metodo2'), function ($e)
// {
//     echo $e->getName()."\n" ; // Pega o nome do evento
//     echo get_class($e->getTarget())."\n" ; //Pega o nome da classe
//     echo $e->getParam('valor')."\n";
// });

//Configura o listener para todos os métodos da classe Exemplo, usando o '*'
$events->attach('SON\Event\Exemplo', '*', function ($e)
{
    echo $e->getName()."\n" ; // Pega o nome do evento
    echo get_class($e->getTarget())."\n" ; //Pega o nome da classe
    echo $e->getParam('valor')."\n";
});

//Lista os eventos attachados para a classe Exemplo
// print_r($events->getEvents('SON\Event\Exemplo'));die();

//Lista os listeners da classe Exemplo
// print_r($events->getListeners('SON\Event\Exemplo','*'));die();

//Limpa os listeners da classe Exemplo
$events->clearListeners('SON\Event\Exemplo');

$exemplo->getEventManager()->setSharedManager($events);

$exemplo->metodo(20);
$exemplo->metodo2();

