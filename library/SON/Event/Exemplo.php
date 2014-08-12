<?php
namespace SON\Event;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class Exemplo implements EventManagerAwareInterface
{

    protected $events;

    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__, // A classe atual
            get_called_class() // A classe que chamou esta
                ));
        
        $this->events = $events;
        return $this;
    }

    function getEventManager()
    {
        // Se for a primeira vez que o método foi chamado,
        // cria-se uma instância do EventManager
        if (null == $this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }

    function metodo()
    {
        echo "método executou \n";
    }
}
