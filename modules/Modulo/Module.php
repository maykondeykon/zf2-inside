<?php
namespace Modulo;

use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\EventInterface as Event;

class Module
{

    public function init(ModuleManager $moduleManager)
    {
        //Carrega o eventManager do moduleManager
        $eventManager = $moduleManager->getEventManager();
        
        //Atacha um listener para loadModules.post que executará a função getModulosCarregados
        $eventManager->attach('loadModules.post', array(
            $this, 'getModulosCarregados'
        ));
        
//         print_r($moduleManager->getModule('Modulo'));
    }
    
    //Só executa após todos os módulos serem carregados
    public function getModulosCarregados(Event $e) 
    {
        echo  $e->getName()."<br>";
        echo  get_class($e->getTarget())."<br>";
        
        //Captura o moduleManager completamente carregado
        $moduleManager = $e->getTarget();
        print_r($moduleManager->getLoadedModules());
    }
}

