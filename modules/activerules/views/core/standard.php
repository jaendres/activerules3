<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
?>
<section id="intro">
    <!-- Introduction -->
<?php
    if($intro_title = __(_e('localization_file').'.intro.title'))
    {
        echo '<h1>'.$intro_title.'</h1>';
    }
    if($intro_body = __(_e('localization_file').'.intro.body'))
    {
        echo '<p>'.$intro_body.'</p>';
    }
?>
</section> 
<div id="content">
        <div id="mainContent">
            <section>
                <!-- Content -->
                <?php
                    $main = NULL;
                    foreach(__(_e('localization_file').'.main_content') as $item)
                    {
                       $main .= '<h2>'.$item['title'] .'</h2>';

                       if(is_array($item['body']))
                       {
                           foreach($item['body'] as $paragraph)
                           {
                               $main .= '<p>'.$paragraph.'</p>';
                           }
                       }
                       else
                       {
                           $main .= '<p>'.$item['body'] .'</p>';
                       }
                    }

                    echo $main;
                ?>
            </section>
        </div>
        <aside>
            <!-- Sidebar -->
            <?php
            $asides = NULL;
            foreach(__(_e('localization_file').'.aside_content') as $aside)
            {
                $asides .= '<h2>'.$aside['title'].'</h2>';
                if(is_array($aside['body']))
                {
                    foreach($aside['body'] as $sub_item)
                    {
                        $asides .= '<h3>'.$sub_item['title'].'</h3>';
                        $asides .= '<p>';
                        if($sub_item['date'])
                        {
                            $asides .= '<span style="font-size: small; font-weight: bold;">'.$sub_item['date'].'</span><br>';
                        }
                        $asides .= $sub_item['body'].'</p>';
                    }
                }
            }
            echo $asides;
            ?>
        </aside>
</div>

