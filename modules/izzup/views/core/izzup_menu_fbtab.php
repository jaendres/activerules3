<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
$menu = Page::get_core_data('izzup_menu');

?>
<style type="text/css">

.toggle a {
cursor:pointer;
}
.imenu_description { border-top: 2px; border-color: black}
.imenu_name { font-size: large; }
.imenu_hours td{ vertical-align: top }
.imenu_subcats { margin: auto }
.imenu_special { border: #000; border-width: 1px}
.toggle_tabs ul{
    list-style: none;
	padding:0;
	margin:0;
}
.toggle_tabs li{
    display: inline;
	border: solid;
	border-width: 1px 1px 0 1px;
	margin: 0 0.5em 0 0;
    font-size: large;
}
.powered_by {
    font-size: x-small;
}
</style>
<div class="tabs clearfix">
<center>
    <div class="left_tabs" style="width:100%;">
        <ul class="toggle_tabs clearfix" id="toggle_tabs_unused" style="float:none;margin:auto;">

            <?php
            $count = 0;
            foreach($menu['sections'] as $alias => $data)
            {
                $count++;
                if($count === 1)
                {
                    $li_class = ' class="first" ';
                    $a_class = ' class="selected" ';
                }
                else
                {
                    $li_class = '';
                    $a_class = '';
                }

                echo '<li'.$li_class.'><a href="#" '.$a_class.' onclick="tab_type_calls[\''.$alias.'\'](this);return false;">'.$data['name'].'</a></li>'."\n";

            }
            ?>
        </ul>
    </div>
</center>
</div>
<div class="powered_by"><center><a href="http://izzup.com">Powered by Izzup!</a></center></div>

<div id="sections">
<?php
$count = 0;
foreach($menu['section_data'] as $alias => $data)
{
    $count++;
    if($count > 1)
    {
        $style = ' style="display:none" ';
    }
    else
    {
        $style = '';
    }
    echo '<div id="'.$alias.'_container" '.$style.'>';
    if(count($data['subcats']) === 1)
    {
        // Display the section description and serving hours
        echo '<hr>';
        echo '<div class="imenu_description">'.$data['subcats'][0]['description'].'</div>';
        echo '<div class="imenu_hours"><table><tr><td>'.__('izzup_menu.hours_served').': </td><td>'.$data['subcats'][0]['hours'].'</td></tr></table></div>';

        if($alias !== 'specials')
        {
            if(!empty($data['subcats'][0]['items']))
            {
                echo '<table class="imenu_item">';
                foreach($data['subcats'][0]['items'] as $item_alias => $item)
                {
                    echo '<tr><td>'.$item['name'].'</td><td>'.$item['price'].'</td></tr>';
                    if(!empty($item['description']))
                    {
                        echo '<tr><td colspan="2">'.$item['description'].'</td></tr>';
                    }
                }
                echo '</table>';
            }
        }
        else
        {
            if(!empty($data['subcats'][0]['items']))
            {
                echo '<table border=2 class="imenu_special">';
                foreach($data['subcats'][0]['items'] as $date => $specials)
                {
                    foreach($specials as $item)
                    {
                        echo '<tr><td>'.$date.'</td><td>'.$item['name'].'</td><td>'.$item['price'].'</td></tr>';
                        if(!empty($item['description']))
                        {
                            echo '<tr><td>&nbsp;</td><td colspan="2">'.$item['description'].'</td></tr>';
                        }
                    }

                }
                echo '</table>';
            }
        }
    }
    else
    {
        echo '<div class="imenu_subcats">| ';
        foreach($data['subcats'] as $sub_alias => $sub_data)
        {
            echo '<a href="#'.$sub_alias.'">'.$sub_data['name'].'</a> | ';
        }
        echo '</div>';

        foreach($data['subcats'] as $sub_alias => $sub_data)
        {
            echo '<hr>';
            echo '<div class="imenu_description">'.$sub_data['description'].'</div>';
            echo '<div class="imenu_hours"><table><tr><td>'.__('izzup_menu.hours_served').': </td><td>'.$sub_data['hours'].'</td></tr></table></div>';

             if(!empty($sub_data['items']))
            {
                echo '<table class="item">';
                foreach($sub_data['items'] as $item_alias => $item)
                {
                    echo '<tr><td>'.$item['name'].'</td><td>'.$item['price'].'</td></tr>';
                    if(!empty($item['description']))
                    {
                        echo '<tr colspan="2"><td>'.$item['description'].'</td></tr>';
                    }
                }
                echo '</table>';
            }
        }


    }

    echo '</div>';
}
?>
</div>

<script>
var tab_type_calls = [];
<?php
foreach($menu['sections'] as $alias => $data)
{
    echo "tab_type_calls['".$alias."'] = function(t) {toggletabs(t,function() {switchtypetab('".$alias."');});};";
}
?>

function toggletabs(e,callback) {
    if(e.hasClassName('selected')) {
        return false;
    }
    var p = e.getParentNode().getParentNode().getChildNodes();
    for(var a = 0;a < p.length;a++) {
        if(p[a].getTagName().toLowerCase() == 'li') {
            p[a].getChildNodes()[0].removeClassName('selected');
        }
    }
    e.addClassName('selected');
    callback();
    return false;
}
function switchtypetab(t) {
    //set all divs to hidden
<?php
foreach($menu['sections'] as $alias => $data)
{
    echo 'if(t=="'.$alias.'")
    {
        document.getElementById("'.$alias.'_container").setStyle("display","block");
    }
    else
    {
        document.getElementById("'.$alias.'_container").setStyle("display","none");
    }'."\n";
}
?>
}
</script>