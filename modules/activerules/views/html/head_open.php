<?php defined('SYSPATH') or die('No direct script access.');
/**
 *	HTML HEAD open tag
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2010 Ultri Group LLC
 */
	echo "\n";

    $title = _p('title');

	if(empty($title))
	{
		$title = '';

        if(Site::instance()->sub_host())
		{
			$title .= Site::instance()->sub_host(). ' - ' ;
		}

		$title .= Site::conf('common_name', Site::conf('name'));
	}

?>
<head>
<title><?php echo $title ?></title>
<?php
	/*
     * if(ar::get_conf(array('output', 'site'), 'meta_description'))

	{
		echo "\n".'<meta name="description" value="'.ar::get_conf(array('output', 'site'), 'meta_description').'" />';
	}
	if(ar::get_conf(array('output', 'site'), 'meta_keywords'))
	{
		echo "\n".'<meta name="keywords" value="'.ar::get_conf(array('output', 'site'), 'meta_keywords').'" />';
	}
    */
?>
