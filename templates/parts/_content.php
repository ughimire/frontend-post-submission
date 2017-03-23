<div class="form-group">
    <label for="<?= $front_key; ?>"><?= $label; ?></label>
    <?php
    $content = '';
    $editor_id = $front_key;
    $settings = array('media_buttons' => false);
    wp_editor($content, $editor_id, $settings);
    ?>
</div>