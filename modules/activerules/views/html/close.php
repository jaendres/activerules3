<?php
// Closes the BODY tag </body>
echo View::factory('html/body_close')->render();

//Add footer_include
echo View::factory('html/foot_include')->render();

// Opens the HTML tag </html>
echo View::factory('html/html_close')->render();

// Flush output to browser to end display.
// Kohana Still needs to do dome cleanup and shutdown.
ob_flush();
flush();

?>
