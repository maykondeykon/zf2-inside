<?php
namespace SON;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
<<<<<<< HEAD
/**
 * Classe para fabricação de objetos do tipo Categoria
 * @author maykon
 *
 */
class CategoriaFactory implements FactoryInterface
{
    
//     Implementa o método da ServiceLocatorInterface
 public function createService(ServiceLocatorInterface $serviceLocator) {
    
     //Pega a instância de Connection usando o service locator do service manager
     $connection = $serviceLocator->get('Connection');
     
//      Retorna uma instância de Categoria passando os parâmetros de conexão
=======

class CategoriaFactory implements FactoryInterface
{
    
 public function createService(ServiceLocatorInterface $serviceLocator) {
    
     //Pega a instância de Connection
     $connection = $serviceLocator->get('Connection');
     
>>>>>>> refs/remotes/origin/master
     return new Categoria($connection); //Instância apenas Categoria, pois esta classe está no mesmo namespace

 }

}
