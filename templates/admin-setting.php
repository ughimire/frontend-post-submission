<div class="wrap">
    <h2>Label is : <?= $Label; ?></h2>
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


<div class="wrap">
    <h1>My Settings</h1>
    <form method="post" action="options.php">
        <?php
        // This prints out all hidden setting fields
        settings_fields('my_option_group');

        do_settings_sections('my-setting-admin');

        submit_button();

        ?>
    </form>
</div>