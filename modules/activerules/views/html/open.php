<?php
$out = '';

//$out .= View::factory('html/html_open')->render();
$out .= View::factory('html/fb_html_open')->render();

// Provides opening HEAD tag <head>
$out .= View::factory('html/head_open')->render();

// Provides JS and CSS code and links
$out .= View::factory('html/head_include')->render();

// Provides closing HEAD tag </head>
$out .= View::factory('html/head_close')->render();

// Opens the BODY tag <body>
// Body attributes are handled in a consistent manner here.
$out .= View::factory('html/body_open')->render();

echo $out;
// Flush output to browser if possible for quicker loading
//ob_flush();
//flush();

?>
