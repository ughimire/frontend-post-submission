<?php


class  FPAdminSetting
{
    private $options;

    public function Load()
    {


        add_action('admin_init', array($this, 'page_init'));

        add_action('admin_menu', array($this, 'RenderAdminPage'));


    }

    /**
     * Option page for plugin
     */
    public function RenderAdminPage()
    {

        $this->loadScript();

        add_menu_page(FP_BUILDER_SUBMISSION_LABEL, FP_BUILDER_SUBMISSION_LABEL, 'manage_options', FP_BUILDER_PLUGIN_NAME, array($this, 'create_admin_page'));

    }


    function loadScript()
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
            "Label" => "This is heading of the plugin",
            "Options" => $this->options


        );

        LoadView("admin-setting", $data);
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'fp_post_option_group', // Option group
            'fp_post_option_name', // Option name
            array($this, 'sanitize') // Sanitize
        );

        /* add_settings_section(
             'setting_section_id', // ID
             'My Custom Settings', // Title
             array($this, 'print_section_info'), // Callback
             'my-setting-admin' // Page
         );*/

        /*add_settings_field(
            'id_number', // ID
            'ID Number', // Title
            array($this, 'id_number_callback'), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section
        );*/

        /*  add_settings_field(
              'title',
              'Title',
              array($this, 'title_callback'),
              'my-setting-admin',
              'setting_section_id'
          );*/
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

        if (isset($input['post_title_label']))
            $new_input['post_title_label'] = sanitize_text_field($input['post_title_label']);

        return $new_input;
    }


}