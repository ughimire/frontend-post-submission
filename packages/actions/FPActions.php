<?php


class  FPActions
{


    public function Load()
    {
        add_action('wp_ajax_nopriv_FPPostSave', array($this, 'FPPostSaveAction'));

        add_action('wp_ajax_FPPostSave', array($this, 'FPPostSaveAction'));


    }

    private function ValidateFormAndNonce($data)
    {


        $isNonceValid = false;

        $message = "";

        $options = get_option('fp_post_option_name');

        $date = date('Y-m-d');
        if (wp_verify_nonce($_POST['fp_post_security'], 'FP_POST_SAVE_KEY' . $date)) {


            $isNonceValid = true;

        }


        if ($options['is_visible_fp_post_title']) {


            if (isset($_POST['fp_post_title']) && $_POST['fp_post_title'] != "") {

                $formValid = true;
            } else {


                $formValid = false;

                $message .= "Post title required.";

            }

        }


        if ($options['is_visible_fp_author_name']) {


            if (isset($_POST['fp_author_name']) && $_POST['fp_author_name'] != "") {

                $formValid = true;
            } else {

                $formValid = false;

                $message .= "Authro name required.";

            }

        }


        return ($isNonceValid && $formValid) ? "" : "Form validation issue, please check again.";
    }

    function FPPostSaveAction()
    {


        $error = $this->ValidateFormAndNonce($_POST);


        if ($error == "") {

            $post_information = array(
                'post_title' => wp_strip_all_tags($_POST['fp_post_title']),
                'post_content' => "Hello Wocntent",
                'post_type' => 'post',
                'post_status' => 'pending',
                "post_author" => "Umesh ghimire nepal "
            );

            wp_insert_post($post_information);
            $redirect = $_POST['_wp_http_referer'] . add_query_arg('my-form', 'success', $redirect);
            wp_redirect($redirect);


        } else {

            echo "Not valid";
        }
        die('die');
    }


}