<div class="form-group">
    <label for="<?= $front_key; ?>"><?= $label; ?></label>
    <?php
    $content = '';
    $editor_id = $front_key;
    $settings = array(
        'media_buttons' => false,
        'theme_advanced_disable' => 'fullscreen'


    );

    wp_editor($content, $front_key, $settings);
    ?>
</div>