<?php


class  FPShortCode
{

    public function Load()
    {


        add_action('init', array($this, 'RegisterShortCode'));

    }

    public function RegisterShortCode()
    {

        add_shortcode('frontend-post-submission', array($this, 'FrontendPostSubmissionShortCode'));

    }


    public function FrontendPostSubmissionShortCode($atts)
    {

        pp($atts);


    }
}