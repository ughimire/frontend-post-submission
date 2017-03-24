<?php


class  FPAdminSetting
{
    private $options;

    // default fuction - it calls from registerPackage method of FPLoader class
    public function load()
    {


        add_action('admin_init', array($this, 'pluginInitAdmin'));

        add_action('admin_menu', array($this, 'renderAdminPage'));


    }

    /**
     * Option page for plugin
     */
    public function renderAdminPage()
    {

        $this->loadScript();

        add_menu_page(FP_BUILDER_SUBMISSION_LABEL, FP_BUILDER_SUBMISSION_LABEL, 'manage_options', FP_BUILDER_PLUGIN_NAME, array($this, 'createAdminPage'));

    }


    function loadScript()
    {
        wp_enqueue_script(
            'fp-admin',
            FP_BUILDER_PLUGIN_URL . 'js/fp-admin.js', // <----- get_stylesheet_directory_uri() if used in a theme
            array('jquery-ui-sortable', 'jquery') // <---- Dependencies
        );
    }


    /**
     * Options page callback
     */
    public function createAdminPage()
    {
        // Set class property
        $this->options = get_option('fp_post_option_name');

        $sortingOrder = $this->options['fp_sortable_list_json'];

        $formFields = array();

        try {

            $sortingOrderArray = json_decode($sortingOrder);

            if (count($sortingOrderArray) < 1) {

                $sortingOrderArray = array_keys(FPForm::$formFields);
            }

            foreach ($sortingOrderArray as $field) {

                $formFields[$field] = FPForm::$formFields[$field];
            }


        } catch (Exception $e) {

            $formFields = FPForm::$formFields;

        }


        $data = array(
            "pluginHeading" => "Frontend Post Submission Plugin",
            "options" => $this->options,
            "formField" => $formFields,
            "prefix" => FPForm::$visiblePrefix


        );

        load_plugin_view("admin-setting", $data);
    }

    /**
     * Register and add settings
     */
    public function pluginInitAdmin()
    {
        register_setting(
            'fp_post_option_group', // Option group
            'fp_post_option_name', // Option name
            array($this, 'sanitize') // Sanitize
        );

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {

        $formFields = FPForm::$formFields;

        /* if (null == $input['post_title_label']) {
             add_settings_error(
                 'requiredTextFieldEmpty',
                 'empty',
                 'Cannot be empty',
                 'error'
             );

            we can make validation of the form by this above commented script
         }*/
        $new_input = array();

        if (isset($input[$formFields['post_title']['admin_key']]))

            $new_input[$formFields['post_title']['admin_key']] = ($input[$formFields['post_title']['admin_key']]);

        if (isset($input[$formFields['author_name']['admin_key']]))
            $new_input[$formFields['author_name']['admin_key']] = ($input[$formFields['author_name']['admin_key']]);

        if (isset($input[$formFields['post_content']['admin_key']]))

            $new_input[$formFields['post_content']['admin_key']] = ($input[$formFields['post_content']['admin_key']]);

        if (isset($input[$formFields['feature_image']['admin_key']]))

            $new_input[$formFields['feature_image']['admin_key']] = ($input[$formFields['feature_image']['admin_key']]);

        if (isset($input["fp_sortable_list_json"]))

            $new_input["fp_sortable_list_json"] = ($input["fp_sortable_list_json"]);


        foreach ($formFields as $key => $form) {


            if (isset($input[FPForm::$visiblePrefix . $form["admin_key"]])) {

                $new_input[FPForm::$visiblePrefix . $form["admin_key"]] = 1;

            } else {


                $new_input[FPForm::$visiblePrefix . $form["admin_key"]] = 0;

            }

        }

        return $new_input;
    }


}