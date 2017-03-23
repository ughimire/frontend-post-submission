<?php


class  FPShortCode
{

    private $options;


    public function Load()
    {
        add_action('wp_enqueue_scripts', array($this, 'add_jQuery_libraries'));


        add_action('init', array($this, 'RegisterShortCode'));


    }

    function add_jQuery_libraries()
    {

        // Registering Scripts
        wp_register_script('google-hosted-jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false);

        wp_register_script('jquery-validation-plugin', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js', array('google-hosted-jquery'));

        // Enqueueing Scripts to the head section
        wp_enqueue_script('google-hosted-jquery');
        wp_enqueue_script('jquery-validation-plugin');
    }

    public function RegisterShortCode()
    {

        //$this->replace_jquery();

        add_shortcode('frontend-post-submission', array($this, 'FrontendPostSubmissionShortCode'));

    }


    public function FrontendPostSubmissionShortCode($atts)
    {
        $this->options = get_option('fp_post_option_name');

        $formFields = FPForm::$formFields;

        $data = array(
            "label" => "This is heading of the plugin",
            "options" => $this->options,
            "formField" => $formFields,
            "prifix" => FPForm::$visiblePrefix


        );

        LoadView("ui-form", $data);


    }
}