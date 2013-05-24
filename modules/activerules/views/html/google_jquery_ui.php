<?php
	if(Request::$protocol == 'https')
	{
		$url = 'https://www.google.com/jsapi?key='.Site::conf('google.api_key');
	}
	else
	{
		$url = 'http://www.google.com/jsapi?key='.Site::conf('google.api_key');
	}
?>
<script type="text/javascript" src="<?php echo $url; ?>"></script>
<script type="text/javascript">
	google.load("jquery", "1.4.2");
	// google.load("jqueryui", "1.8.13"); 
</script>

