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

//-- Request HTTP

//Tipo de requisição, endereço, versão do http
// GET URI 1.1

//informação sobre o conteúdo
// HEADERS Content-Type: text/html
//mensagem
// BODY -> conteúdo

use Zend\Http\Request;

//Cria a requisição http GET-- não envia
// $request = new Request();
// $request->setMethod(Request::METHOD_GET);
// $request->setUri('http://google.com');
// $request->setContent("Conteúdo da nossa request\n");

// echo $request->toString();

//Cria a requisição http POST-- não envia
// $request = new Request();
// $request->setMethod(Request::METHOD_POST);
//Seta parâmetros na requisição
// $request->getPost()->set('nome', 'maykon');
// $request->getPost()->set('x', '10');

// $request->setUri('http://google.com');
// $request->setContent($request->getPost()->toString()."\n");

// echo $request->toString();


//--Headers

$request = new Request();
$request->setMethod(Request::METHOD_POST);
//Seta parâmetros na requisição
$request->getPost()->set('nome', 'maykon');
$request->getHeaders()->addHeaders(array('headerX'=>10, 'headerY'=> 20));
$request->getHeaders()->addHeaderLine('Content-Type: text/html');
$request->setUri('http://google.com');
$request->setContent($request->getPost()->toString()."\n");

echo $request->toString();


































