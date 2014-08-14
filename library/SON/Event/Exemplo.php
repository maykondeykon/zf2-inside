<?php

namespace SON\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

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

    function metodo($valor)
    {
        echo "método executou \n";
        
        //Gatilho
        $this->getEventManager()->trigger(
            __FUNCTION__,   //Pega o nome da função atual e usa como nome do trigger
            $this,   //Contexto, a própria classe
            array('valor'=>$valor)
        );
    }
    
    function metodo2() {
        //Gatilho
        $this->getEventManager()->trigger(
            __FUNCTION__,   //Pega o nome da função atual e usa como nome do trigger
            $this,   //Contexto, a própria classe
            array('valor'=>'valor qualquer')
        );
    }
    
    public function metodo3($valor)
    {
    	$arg = compact('valor');
    	$results = $this->getEventManager()->triggerUntil(
			        	__FUNCTION__,
			    		$this,
    					$arg,
			    		function() use($valor) {
			    			if($valor == 1) {
			    				return true;
			    			}
			    		}
			    	);
    	
    	if($results->stopped()) {
    		echo "Parou a execução.\n";
    		return $results->last();
    	}
    	
    	echo "Execução continuando...\n";
    }

    public function teste()
    {
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            array('valor' => 'metodo de teste\n')
        );
    }

    public function multiplosEventos($valor) {
        $arg = compact('valor');    // Cria um array com a variável $valor

        $this->getEventManager()->trigger(
                __FUNCTION__.'.pre',
                $this,
                $arg
            );

        echo "Conteudo do metodo sendo executado\n";

        $this->getEventManager()->trigger(
                __FUNCTION__.'.post',
                $this,
                array('valor' => 'executou depois\n')
            );
    }
}
