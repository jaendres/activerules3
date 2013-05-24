<?php  defined('SYSPATH') or die('No direct script access.');
/**
 *	HTML open tag
 *
 * @package    ActiveRules
 * @package	   Site
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
// Get locale or default to English
$locale_lang = ar::get_conf('locale', 'language', 'ja');
$doc_lang = $locale_lang;
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="<?= $doc_lang ?>" lang="<?= $doc_lang ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

