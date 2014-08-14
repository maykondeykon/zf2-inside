<?php
namespace SON\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManager;

/**
 * Classe para gerênciamento dos listeners
 *
 * @author maykon
 *        
 */
class ExemploListener implements ListenerAggregateInterface
{

    protected $listeners = array();

    function attach(EventManagerInterface $events)
    {
        // Executa o método ExecutaPre quando o gatilho multiplosEventospre for disparado
        $this->listeners[] = $events->attach('multiplosEventos.pre', array(
            $this,
            'executaPre'
        ), 100);
        
        // Executa o método ExecutaPos quando o gatilho multiplosEventospos for disparado
        $this->listeners[] = $events->attach('multiplosEventos.post', array(
            $this,
            'executaPos'
        ), - 100);
    }

    //Remove os listeners
    function detach(EventManagerInterface $event)
    {
        foreach ($this->listeners as $k => $listener) {
            if ($event->detach($listener))
                unset($this->listeners[$k]);
        }
    }

    function executaPre()
    {
        echo "Executou Pre\n";
    }

    function executaPos()
    {
        echo "Executou Post\n";
    }
}