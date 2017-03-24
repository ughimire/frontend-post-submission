<?php


class  FPActions
{


    private $postData = array();

    public function load()
    {
        add_action('wp_ajax_nopriv_FPPostSave', array($this, 'FPPostSaveAction'));

        add_action('wp_ajax_FPPostSave', array($this, 'FPPostSaveAction'));


    }

    private function validateForm($data)
    {
        $validation = true;

        $options = get_option('fp_post_option_name');

        $sortingOrder = isset($options['fp_sortable_list_json']) ? $options['fp_sortable_list_json'] : "";

        $adminFormField = FPForm::$formFields;

        try {

            $sortingOrderArray = json_decode($sortingOrder);

            if (count($sortingOrderArray) < 1) {

                $sortingOrderArray = array_keys($adminFormField);
            }

            foreach ($sortingOrderArray as $field) {

                if (isset($options[FPForm::$visiblePrefix . $adminFormField[$field]["admin_key"]])) {

                    if ($options[FPForm::$visiblePrefix . $adminFormField[$field]["admin_key"]] == 1) {

                        if ($adminFormField[$field]["admin_key"] == "fp_feature_image") {

                            if (!isset($_FILES[$field]['tmp_name'])) {

                                $validation = false;
                                break;
                                
                            } else {

                                $mime = $_FILES[$field]['type'];

                                if (($mime != 'image/jpeg') && ($mime != 'image/jpg') && ($mime != 'image/png')) {

                                    $validation = false;
                                    break;
                                }
                            }

                        } else {
                            if (!isset($data[$field]) || (isset($data[$field]) && $data[$field] == "")) {


                                $validation = false;

                                break;
                            }

                        }
                    }
                }
            }

        } catch (Exception $e) {


        }

        return $validation;
    }

    private function validateFormAndNonce($data)
    {


        $isValid = false;


        $date = date('Y-m-d');

        if (wp_verify_nonce($_POST['fp_post_security'], 'FP_POST_SAVE_KEY' . $date) && ($this->validateForm($data))) {


            $isValid = true;


        }


        return $isValid;
    }

    function FPPostSaveAction()
    {
        $status = $this->validateFormAndNonce($_POST);

        $referer = explode("?", $_SERVER['HTTP_REFERER']);
        $referer_url = $referer[0];
        if ($status == true) {

            $post_information = array(
                'post_title' => isset($_POST['post_title']) ? wp_strip_all_tags($_POST['post_title']) : "",
                'post_content' => isset($_POST['post_content']) ? ($_POST['post_content']) : "",
                'post_type' => 'post',
                'post_status' => 'pending',
                'post_author' => ''

            );

            $postID = wp_insert_post($post_information);

            isset($_POST['author_name']) ? add_post_meta($postID, 'post_author', $_POST['author_name']) : "";


            // These files need to be included as dependencies when on the front end.
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            // Wordpress file upload logic

            if (isset($_FILES['feature_image']['tmp_name'])) {

                $attachment_id = media_handle_upload('feature_image', $postID);
                set_post_thumbnail($postID, $attachment_id);
            }

            $redirect = $referer_url . "?status=success";

        } else {

            $redirect = $referer_url . "?status=failed";

        }


        wp_redirect($redirect);
        die('die');
    }


}