<?php

if (!function_exists("pp")) {


    function pp($array = array(), $isDie = true)
    {

        echo '<pre>';


        print_r($array);

        echo '</pre>';

        if ($isDie) {
            die();
        }
    }
}
if (!function_exists("LoadView")) {


    function LoadView($viewName, $data = array())
    {


        $templatePath = FP_BUILDER_PLUGIN_TEMPLATES_DIR . $viewName;

        $response = "";

        if (file_exists($templatePath)) {

            ob_start();

            extract($data);

            require_once $templatePath;

            foreach ($data as $key => $value) {

                unset($$key);

            }

            $response = ob_get_contents();


            ob_end_clean();


        } else if (file_exists($templatePath . '.php')) {

            ob_start();

            extract($data);

            require_once $templatePath . '.php';


            foreach ($data as $key => $value) {

                unset($$key);

            }

            $response = ob_get_contents();

            ob_end_clean();

        }


        echo $response;


    }
}
?>