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
 */