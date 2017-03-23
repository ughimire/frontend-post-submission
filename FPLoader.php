<?php

class FPLoader
{

    private $registeredPackages = array();

    private static $instance = null;


    // Plugin initialize from here
    public static function fpLoad()
    {

        if (self::$instance == null) {

            self::$instance = new FPLoader();

        }
        spl_autoload_register(array(self::$instance, 'autoloader'));

        self::$instance->loadHelper();

        self::$instance->registerAndLoadPackages();

    }

// load helper (where  common functions are located for this plugin)
    function loadHelper()
    {
        $helperPath = FP_BUILDER_PLUGIN_HELPER_DIR . 'helper.php';

        if (file_exists($helperPath)) {


            require_once $helperPath;

        }

    }

// autoloader method for the plugin. Autoload packages
    function autoloader($class)
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
    private static function getInstance($packageName)
    {

        $instance = new self::$instance->registeredPackages[$packageName];

        return $instance;
    }

    // register new package
    private function registerPackages($packages = array())
    {

        if (count(array_keys($packages)) != count(array_values($packages))) {

            throw  new Exception("package key value missmatch.");
        }

        $this->registeredPackages = $packages;


    }

// Register and auto load packages
    private function registerAndLoadPackages()
    {

        $this->registerPackages(array(

                "shortcode" => "FPShortCode", // Key == Package directory name and Value is Package Main class name

                "admin-setting" => "FPAdminSetting",

                "form" => "FPForm",

                "actions" => "FPActions"

            )
        );


        $this->loadPackage("shortcode");

        if (is_admin()) {

            $this->loadPackage("admin-setting");
        }
        $this->loadPackage("form");

        $this->loadPackage("actions");
    }

    private function loadPackage($packageName)
    {
        try {

            if (!isset($this->registeredPackages[$packageName])) {

                throw  new Exception("Package not registered yet.");

            }

            self::getInstance($packageName)->load();

        } catch (Exception $e) {


            echo '<h1>' . $e->getMessage() . '</h1>';
        }

    }


}

?>