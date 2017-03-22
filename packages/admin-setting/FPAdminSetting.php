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

        add_menu_page(FP_BUILDER_SUBMISSION_LABEL, FP_BUILDER_SUBMISSION_LABEL, 'manage_options', FP_BUILDER_PLUGIN_NAME, array($this, 'moveit_callback'));

    }


    function move_me_around_scripts()
    {
        wp_enqueue_script(
            'move-it',
            FP_BUILDER_PLUGIN_URL. 'moveit.js', // <----- get_stylesheet_directory_uri() if used in a theme
            array('jquery-ui-sortable', 'jquery') // <---- Dependencies
        );
    }

    function moveit_callback()
    {

        ?>
        <div class="wrap">
            <h2>I like to move it, move it</h2>
            <div class="meta-box-sortables ui-sortable">
                <div class="postbox" id="p1">
                    <h3 class="hndle">Drag me around, babe</h3>
                    <div class="container">
                        <p>Your content goes here</p>
                    </div>
                </div><!-- .postbox -->
                <div class="postbox" id="p2">
                    <h3 class="hndle">Drag me, too</h3>
                    <div class="container">
                        <p>Your content goes here, again</p>
                    </div>
                </div><!-- .postbox -->
            </div><!-- .meta-box-sortables.ui-sortable-->
        </div><!-- .wrap -->

        <?php
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option('my_option_name');
        ?>
        <!-- <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
                <?php
        /*                // This prints out all hidden setting fields
                        settings_fields('my_option_group');
                        do_settings_sections('my-setting-admin');
                        submit_button();
                        */
        ?>
            </form>
        </div>-->

        <div class="wrap">
            <h2>I like to move it, move it</h2>
            <div class="meta-box-sortables ui-sortable">
                <div class="postbox" id="p1">
                    <h3 class="hndle">Drag me around, babe</h3>
                    <div class="container">
                        <p>Your content goes here</p>
                    </div>
                </div><!-- .postbox -->
                <div class="postbox" id="p2">
                    <h3 class="hndle">Drag me, too</h3>
                    <div class="container">
                        <p>Your content goes here, again</p>
                    </div>
                </div><!-- .postbox -->
            </div><!-- .meta-box-sortables.ui-sortable-->
        </div><!-- .wrap -->
        <?php
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