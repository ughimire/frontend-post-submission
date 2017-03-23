<div class="wrap">
    <h2>Label is : <?= $Label; ?></h2>
    <form method="post" action="options.php">
        <div class="meta-box-sortables ui-sortable">

            <?php
            settings_fields('fp_post_option_group');


            ?>

            <div class="postbox" id="p1">
                <h3 class="hndle">Post Title</h3>
                <div class="container">
                    <p>Your content goes here</p>
                    <?php printf('<input type="text" id="id_number" name="fp_post_option_name[id_number]" value="%s" />', isset($Options['id_number']) ? esc_attr($Options['id_number']) : '') ?>
                    <?php printf('<input type="text" id="post_title_label" name="fp_post_option_name[post_title_label]" value="%s" />', isset($Options['post_title_label']) ? esc_attr($Options['post_title_label']) : '') ?>
                </div>
            </div><!-- .postbox -->
            <div class="postbox" id="p2">
                <h3 class="hndle">Author Name</h3>
                <div class="container">
                    <p>Your content goes here, again</p>
                </div>
            </div><!-- .postbox -->

        </div><!-- .meta-box-sortables.ui-sortable-->
        <?php submit_button(); ?>
    </form>
</div><!-- .wrap -->


<div class="wrap">
    <h1>My Settings</h1>
    <form method="post" action="options.php">
        <?php
        // This prints out all hidden setting fields
        // settings_fields('my_option_group');


        ?>
    </form>
</div>