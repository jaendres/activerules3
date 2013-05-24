<?php

echo View::factory('html/open')->render();

echo View::factory(Page::layout())->render();

echo View::factory('html/close')->render();

?>

