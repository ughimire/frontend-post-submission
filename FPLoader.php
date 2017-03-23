<?php

class FPLoader
{

    private $registeredPackages = array();

    private static $instance = null;

    public static function FPLoad()
    {

        if (self::$instance == null) {

            self::$instance = new FPLoader();

        }
        spl_autoload_register(array(self::$instance, 'Autoloader'));

        self::$instance->LoadHelper();

        self::$instance->RegisterAndLoadPackages();

    }

    function LoadHelper()
    {
        $helperPath = FP_BUILDER_PLUGIN_HELPER_DIR . 'helper.php';

        if (file_exists($helperPath)) {


            require_once $helperPath;

        }

    }

    function Autoloader($class)
    {
        $package = array_search($class, $this->registeredPackages);


        if ($package == "" || $package == null) {


            return;
        }

        $classFilePath = FP_BUILDER_PLUGIN_PACKAGES_DIR . $package . FP_BUILDER_DS . $class . '.php';


        if (!file_exists($classFilePath)) {


            throw  new Exception("package main class not found.File " . $classFilePath);

        }
        require_once $classFilePath;


    }

    // Get instance of package
    private static function GetInstance($packageName)
    {

        $instance = new self::$instance->registeredPackages[$packageName];

        return $instance;
    }

    private function RegisterPackages($packages = array())
    {

        if (count(array_keys($packages)) != count(array_values($packages))) {

            throw  new Exception("package key value missmatch.");
        }

        $this->registeredPackages = $packages;


    }

// Register and auto load packages
    private function RegisterAndLoadPackages()
    {

        $this->RegisterPackages(array(

                "shortcode" => "FPShortCode", // Key == Package directory name and Value is Package Main class name

                "admin-setting" => "FPAdminSetting",

                "form" => "FPForm",

                "actions" => "FPActions"

            )
        );


        $this->LoadPackage("shortcode");

        if (is_admin()) {

            $this->LoadPackage("admin-setting");
        }
        $this->LoadPackage("form");

        $this->LoadPackage("actions");
    }

    private function LoadPackage($packageName)
    {
        try {

            if (!isset($this->registeredPackages[$packageName])) {

                throw  new Exception("Package not registered yet.");

            }

            self::getInstance($packageName)->Load();

        } catch (Exception $e) {


            echo '<h1>' . $e->getMessage() . '</h1>';
        }

    }


}

?>