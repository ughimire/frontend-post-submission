<?php


class  FPAdminSetting
{
    private $options;

    public function Load()
    {
        add_action('admin_menu', array($this, 'add_plugin_page'));

        add_action('admin_init', array($this, 'page_init'));


    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"


        /*      $my_page = add_dashboard_page(
                  'Move it',
                  'Move it',
                  'add_users',
                  'moveit-page',
                  array($this, 'moveit_callback')
              );
              //echo $my_page;
              add_action("admin_print_scripts-$my_page", array($this, 'move_me_around_scripts'), 11);*/

        //add_action("wp_enqueue_scripts", "move_me_around_scripts", 10);
        $this->move_me_around_scripts();

        add_menu_page(FP_BUILDER_SUBMISSION_LABEL, FP_BUILDER_SUBMISSION_LABEL, 'manage_options', FP_BUILDER_PLUGIN_NAME, array($this, 'create_admin_page'));

    }


    function move_me_around_scripts()
    {
        wp_enqueue_script(
            'move-it',
            FP_BUILDER_PLUGIN_URL . 'moveit.js', // <----- get_stylesheet_directory_uri() if used in a theme
            array('jquery-ui-sortable', 'jquery') // <---- Dependencies
        );
    }


    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option('my_option_name');

        $data = array(
            "Label" => "This is heading of the plugin"


        );

        LoadView("admin-setting", $data);
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array($this, 'print_section_info'), // Callback
            'my-setting-admin' // Page
        );

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title
            array($this, 'id_number_callback'), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'title',
            'Title',
            array($this, 'title_callback'),
            'my-setting-admin',
            'setting_section_id'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = array();
        if (isset($input['id_number']))
            $new_input['id_number'] = absint($input['id_number']);

        if (isset($input['title']))
            $new_input['title'] = sanitize_text_field($input['title']);

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
            isset($this->options['id_number']) ? esc_attr($this->options['id_number']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="my_option_name[title]" value="%s" />',
            isset($this->options['title']) ? esc_attr($this->options['title']) : ''
        );
    }
}