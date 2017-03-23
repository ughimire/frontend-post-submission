<?php


class  FPShortCode
{

    private $options;


    public function load()
    {
        add_action('wp_enqueue_scripts', array($this, 'addScriptsAndStyles'));


        add_action('init', array($this, 'registerShortCode'));


    }

    function addScriptsAndStyles()
    {

        // Registering Scripts
        wp_register_script('google-hosted-jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false);
        wp_register_script('jquery-validation-plugin', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js', array('google-hosted-jquery'));
        wp_register_style( 'second-style', FP_BUILDER_PLUGIN_URL .'css/style.css', array(), '1');

        // Enqueueing Scripts to the head section
        wp_enqueue_script('google-hosted-jquery');
        wp_enqueue_script('jquery-validation-plugin');
        wp_enqueue_style( 'second-style' );
    }


    public function registerShortCode()
    {


        add_shortcode('frontend-post-submission', array($this, 'frontendPostSubmissionShortCode'));

    }


    public function frontendPostSubmissionShortCode($atts)
    {
        $this->options = get_option('fp_post_option_name');

        $sortingOrder = $this->options['fp_sortable_list_json'];

        $formFields = array();
//        pp($this->options);

        $adminFormField = FPForm::$formFields;
        try {

            $sortingOrderArray = json_decode($sortingOrder);


            if (count($sortingOrderArray) < 1) {

                $sortingOrderArray = array_keys($adminFormField);
            }

            foreach ($sortingOrderArray as $field) {


                if (isset($this->options[FPForm::$visiblePrefix . $adminFormField[$field]["admin_key"]])) {

                    if ($this->options[FPForm::$visiblePrefix . $adminFormField[$field]["admin_key"]] == 1) {
                        $formFields[$field] = array(
                            "front_key" => $field,
                            "label" => isset($this->options[$adminFormField[$field]["admin_key"]]) ? $this->options[$adminFormField[$field]["admin_key"]] : ""

                        );
                    }
                }
            }

        } catch (Exception $e) {


        }


        $data = array(
            "label" => "This is heading of the plugin",
            "options" => $this->options,
            "formField" => $formFields,
            "prifix" => FPForm::$visiblePrefix


        );

        load_plugin_view("ui-form", $data);


    }
}