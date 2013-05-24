<?php
    echo "\n";
    if(Site::conf('in_production', FALSE))
    {
        echo '<script type="text/javascript" src="http://c3269252.r52.cf0.rackcdn.com/activerules/js/activerules.js"></script>';
    }
    else
    {
        echo '<script type="text/javascript" src="/static/js/activerules.js"></script>';
    }
?>