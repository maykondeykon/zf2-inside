<?php
namespace SON;

class Produto 
{

    private $categoria;

    public function setCategoria(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }
}

