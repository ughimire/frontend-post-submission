<?php if (isset($_GET['status'])) {
    echo "<p class='message '" . $_GET['status'] . "'>";

    echo $_GET['status'] == "success" ? "Task successfully completed" : "Something wrong, please try again";

    echo "</p>";
} ?>

<?php

if (count($formField) > 0) {
    ?>
    <div class="row">
        <form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" id="fpPostForm"
              enctype="multipart/form-data">


            <?php

            foreach ($formField as $fieldKey => $fieldArray) {


                load_plugin_view("parts/_" . $fieldKey, $fieldArray);

            } ?>


            <div class="form-group">
                <label for="content"> </label>
                <button type="submit" class="btn btn-primary fpSubmitButton" style="float:right">Submit</button>
            </div>
            <?php
            $date = date('Y-m-d');

            echo wp_nonce_field('FP_POST_SAVE_KEY' . $date, 'fp_post_security'); ?>

            <input type="hidden" name="action" value="FPPostSave"/>
            <div style="clear:both"></div>
        </form>
    </div>
<?php } else {


    echo "<h2>No form field specify</h2>";

} ?>
<script type="text/javascript">

    $("#fpPostForm").validate({
        errorElement: 'span',

    });
</script>