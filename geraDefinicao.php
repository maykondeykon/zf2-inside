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
 * Cria uma lista de definição das classes para ser usada pelo Zend\Di
 */

//Informa o namespace a mapear
$components = array(
    'SON'
);

//Percorre o namespace listando os componentes de cada classe
foreach ($components as $component) {
    $diCompiler = new Zend\Di\Definition\CompilerDefinition();
    $diCompiler->addDirectory('library/' . $component);
    
    $diCompiler->compile();
    
    //Cria o arquivo de definição
    file_put_contents(
    'data/di/' . $component . '-definition.php', 
    '<?php return ' . var_export($diCompiler->toArrayDefinition()->toArray(), true).';'
    );
}