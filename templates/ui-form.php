<?php if (filter_input(INPUT_GET, 'my-form') === 'success') : ?>

    Congrats!

<?php endif ?>

<form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>   " id="form">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" id="fp_post_title" name="fp_post_title"
               placeholder="Enter post title" required>
    </div>
    <div class="form-group">
        <label for="author_name">Author name</label>
        <input type="text" class="form-control" id="fp_author_name" name="fp_author_name"
               placeholder="Enter author name" required>s
    </div>


    <div class="form-group">
        <label for="feature_image">Feature Image</label>
        <input type="file" class="form-control-file" id="feature_image" name="feature_image" required>

    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <?php

        $content = '';
        $editor_id = 'fp_post_editor';
        $settings = array('media_buttons' => false);

        wp_editor($content, $editor_id, $settings);
        ?>
    </div>
    <div class="form-group">
        <label for="content"> </label>
        <button type="submit" class="btn btn-primary " style="float:right">Submit</button>
    </div>
    <?php
    $date = date('Y-m-d');

    echo wp_nonce_field('FP_POST_SAVE_KEY' . $date, 'fp_post_security'); ?>

    <input type="hidden" name="action" value="FPPostSave"/>
</form>

<script type="text/javascript">

    $("#form").validate({
        errorElement: 'span',
        submitHandler: function (form) {

            var _data = {'action': 'UserRegistrationVasDigest'}
            $(form).ajaxSubmit({
                dataType: 'json',
                data: _data,
                success: function (resp) {
                    alert('success');
                    $("#form").fadeOut('ease', function () {
                        $("#form").html('<p>Enquiry submitted we would be in touch soon.</p>');
                        $("#form").fadeIn('ease');
                    });
                }
            });
        }
    });
</script>