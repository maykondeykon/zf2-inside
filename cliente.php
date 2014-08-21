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

use Zend\Http\Request;
use Zend\Http\Client;

// Envia uma requisição para o servidor do google
// $client = new Client('http://google.com');
// $response = $client->send();

// Exibe a resposta do servidor
// echo $response->toString();

// $request = new Request();
// $request->setMethod(Request::METHOD_GET);
// $request->setUri('http://google.com');
// $request->getHeaders()->addHeaderLine('nome: maykon');

// $client = new Client();
// //Envia uma requisição usando uma request específica -- requer um objeto do tipo Request
// $client->dispatch($request);
// echo $client->getResponse()->toString();

// -- Redirects
// $request = new Request();
// $request->setMethod(Request::METHOD_GET);
// $request->setUri('http://google.com');
// $request->getHeaders()->addHeaderLine('nome: maykon');

// $client = new Client('http://google.com', array(
// //limita a quantidade de redirecionamentos do cliente HTTP
// 'maxredirects' => 1
// ));
// // Envia uma requisição usando uma request específica -- requer um objeto do tipo Request
// $client->dispatch($request);
// echo $client->getResponse()->toString();

// // --Adapter\Socket

// //Configuração do adaptador para uso de SSL, no HTTPS
// $config = array(
//     'adapter' => 'Zend\Http\Client\Adapter\Socket',
//     'ssltransport' => 'tls'
// );

// $client = new Client('http://google.com', $config);
// $response = $client->send();
// echo $response->toString();


// --Adapter\Curl

//Configuração do adaptador para uso do Curl
$config = array(
    'adapter' => 'Zend\Http\Client\Adapter\Curl',
    'curloptions' => array(CURLOPT_FOLLOWLOCATION => true),
);

$client = new Client('http://google.com', $config);
$response = $client->send();
echo $response->toString();



















