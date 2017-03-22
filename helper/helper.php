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

?>