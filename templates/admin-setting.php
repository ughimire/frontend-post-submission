<div class="wrap">
    <h2>Label is : <?= $label; ?></h2>
    <form method="post" action="options.php">
        <div class="meta-box-sortables ui-sortable">
            <?php settings_errors(); ?>



            <?php


            settings_fields('fp_post_option_group');


            foreach ($formField as $fieldKey => $fieldArray) {
                ?>

                <div class="postbox fp_setting_sortable" id="<?= $fieldKey ?>" style="padding:20px">
                    <h3 class="hndle"><?= $fieldArray["label"]; ?></h3>
                    <div class="container">
                        <p>Please enter label</p>
                        <?php printf('<input size="40" type="text" id="%s" name="fp_post_option_name[%s]" value="%s" />', $fieldArray["admin_key"], $fieldArray["admin_key"], isset($options[$fieldArray["admin_key"]]) ? esc_attr($options[$fieldArray["admin_key"]]) : '') ?>
                        <label
                            for="isVisible"><span
                                style="margin-left:10px;margin-right:10px;"> Show in frontend ? </span><?php printf('<input type="checkbox" id="%s" name="fp_post_option_name[%s]" value="1" %s/>',
                                $prifix . $fieldArray["admin_key"], $prifix . $fieldArray["admin_key"],
                                isset($options[$prifix . $fieldArray["admin_key"]]) ? $options[$prifix . $fieldArray["admin_key"]] == 1 ? 'checked="checked"' : '' : ''
                            ) ?>
                        </label>
                    </div>
                </div>

            <?php } ?>

            <?php

            printf('<input size="40" type="hidden" id="fp_sortable_list_json" name="fp_post_option_name[fp_sortable_list_json]" value="%s" />',

                (isset($options["fp_sortable_list_json"]) ? esc_attr($options["fp_sortable_list_json"]) : ''
                )
            );


            submit_button(); ?>
    </form>
</div><!-- .wrap -->


