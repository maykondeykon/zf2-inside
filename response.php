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
 * Version | 200 Ok Reason
 * Headers
 * Body
 */

use Zend\Http\Response;

$response = new Response();
$response->setStatusCode(Response::STATUS_CODE_200);
$response->getHeaders()->addHeaderLine('X-Token: JHJUKJBZKJGYEEW');
$response->getHeaders()->addHeaderLine('Content-Type: text/html');
$response->setContent(<<<EEE
    <html>
    <body>
    Ola mundo
    </body>
    </html>
EEE
);
echo $response->getStatusCode();
echo $response->getContent();
