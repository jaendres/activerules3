<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$localization = array(

    'html_page_title' => 'Blog - '.Site::conf('name'),

    'post' => array(
        'name' => 'blog_post_form',

        'display_name' => 'Blog Post',

        'legend' => 'Post',

        'submit' => array(
            'value' => 'Submit',
        ),

        'action' => '/active/form/post/',

        'title' => array (
            'label' => 'Title',
            'help' => 'Choose a useful and descriptive title.'
        ),

        'body' => array (
            'label' => 'Body',
            'help' => 'Enter the content of your blog post up to 1000 characters.'
        ),

    ),



    );
?>
