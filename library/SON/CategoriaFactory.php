<?php
namespace SON;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoriaFactory implements FactoryInterface
{
    
 public function createService(ServiceLocatorInterface $serviceLocator) {
    
     //Pega a instância de Connection
     $connection = $serviceLocator->get('Connection');
     
     return new Categoria($connection); //Instância apenas Categoria, pois esta classe está no mesmo namespace

 }

}