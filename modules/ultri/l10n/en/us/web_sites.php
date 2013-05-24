<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$localization = array(

    'html_title' => 'About '._s('name'),

    'intro' => array (
        'title' => _s('legal_name', _s('name')),
    ),

    'main_content' => array(
        array(
            'title' => 'Philosophy',
            'body' => array(
                    'We believe in offering balanced solutions, tailored to the needs of the client.
                        We use an Open Source LAMPS stack fopr most projects, but if a Windows stack makes more
                        sense for your business we have the skills and infrastructure to support that as well.',
                    'We\'ve put years of development effort into our advanced application framework.
                        ActiveRules is built from the ground up to run in the cloud and is easily customized to meet your needs.
                        It supports all the localization, translation and skinning required to make your site stand out.',
                    'We keep our costs down by utilizing cloud services and maintaining a small permanent staff.
                        For larger projecta we\'re able to tap top industry professionals for the leadership roles and outsource the rest.
                        Our staff will be the only people you will ever interact with. We take care of all communications with outsourced resources and offshore resources.'
                    ),
            ),
        array(
            'title' => 'History',
            'body' => array(
                    'Ultri has been operating under a variety of names and management teams since 1995.
                        Today our people are at the very cutting edge of software development.
                        Let us put our 20 years experience solving Internet and marketing problems to work for you.',
                    ),
            ),
    ),

    'aside_content' => array(
        array(
            'title' => 'FAQ',
            'body' => array(
                array(
                    'title' => 'Do you offer hosting services?',
                    'body' => 'Yes, we offer both turn key hosting and fully managed custom hosting solutions.
                        For turn key hosting visit us at <a href="http://www.domainistrator.com" target="_blank">www.domainistrator.com</a>.
                        If you\'d like additional information on our custom fully managed slutions please <a href="/contact/">contact us</a>.',
                    ),
                ),
        ),
    ),
);
?>