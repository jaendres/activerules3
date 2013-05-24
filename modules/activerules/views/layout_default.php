<?php
echo View::factory('html/open')->render();

echo View::factory(Page::template())->render();

echo View::factory('html/close')->render();
?>

