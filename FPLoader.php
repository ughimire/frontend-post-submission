<?php

class FPLoader
{

    public function __construct()
    {

        spl_autoload_register(array($this, 'autoloader'));
    }


    private function autoloader()
    {


    }
}

?>