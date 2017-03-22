<?php

class FPLoader
{

    private $registeredPackages = array();

    public function __construct()
    {

        spl_autoload_register(array($this, 'Autoloader'));

        $this->RegisterAndLoadPackages();

    }

    function Autoloader()
    {


    }

    // Get instance of package
    private function GetInstance()
    {


    }

    private function RegisterPackages($packages = array())
    {

        if (count(array_keys($packages)) != count(array_values($packages))) {

            throw  new Exception("package key value missmatch.");
        }

        $this->registeredPackages = $packages;

        // add_action('init', array($this, 'register_shortcodes'));

    }

// Register and auto load packages
    private function RegisterAndLoadPackages()
    {

        $this->RegisterPackages(array(

                "shortcode" => "FPShortCode" // Key == Package directory name and Value is Package Main class name

            )
        );

        $this->LoadPackage("shortcode");

    }

    private function LoadPackage($packageName)
    {
        try {

            if (!isset($this->registeredPackages[$packageName])) {

                throw  new Exception("Package not registered yet.");

            }

        } catch (Exception $e) {


        }

    }


}

?>