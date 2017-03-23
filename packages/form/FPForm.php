<?php

class FPForm
{

    public static $visiblePrefix = "is_visible_";

    public static $formFields = array(

        "post_title" => array("label" => "Post Title", "admin_key" => "fp_post_title"),

        "author_name" => array("label" => "Author Name", "admin_key" => "fp_author_name"),

        "content" => array("label" => "Content", "admin_key" => "fp_content"),

        "feature_image" => array("label" => "Feature Image", "admin_key" => "fp_feature_image"),


    );

    public function load()
    {


    }


}

?>