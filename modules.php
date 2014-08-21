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

/*
 Evento:
 - LoadModules -> lista todos os módulos da aplicação (foreach)
    ->Zend\Loader\ModuleAutoloader (Lazy loader)
 - LoadModule -> carrrega cada módulo
    ->loadModule.resolve (retorna uma instância do módulo)
    ->loadModule
        Eventos:
        ->getAutoloaderConfig() -> configura o autoloader do módulo, usando o do Zend ou criando um próprio
        ->getConfig() -> mescla os arquivos de configurações
        ->init(ModuleManager) -> inicia todos os requests do módulo (inicializar somente o necessário)
        ->onBootstrap() -> usa o Zend\Mvc()-> bootstrap event
        ->LocatorRegistrationListener ->  para usa-la deve-se implementar a Zend\ModuleManager\Feature\LocatorRegisteredInterface
        ->ServiceListener -> somente com Zend\Mvc -> carrega services, controllers, plugins, view_helpers
    ->loadModules.post -> indica que todos os módulos foram carregados, podendo atachar listeners agora
 */

use Zend\ModuleManager\Listener;
use Zend\ModuleManager\ModuleManager;

//Configura o caminho dos módulos
$listenerOptions = new Listener\ListenerOptions(array(
    'module_paths' => array(
        './modules'
    )
));

//Agrega vários listeners
$aggregateListener = new Listener\DefaultListenerAggregate($listenerOptions);

//Indica quais módulos devem ser carregados
$moduleManager = new ModuleManager(array(
    'Modulo'
));

//Attacha os listeners ao moduleManager
$moduleManager->getEventManager()->attachAggregate($aggregateListener);

//Carrega os módulos
$moduleManager->loadModules();























