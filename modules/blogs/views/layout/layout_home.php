<?php
    echo View::factory('html/open')->render();
?>
    <div id="header_container">
        <div id="header_content" class="columns clearfix">
            <div class="column first clearfix">
                <h1>
                    <a href="http://sportsword.com">Sportsword.com</a>
                </h1>
            </div>
            <div class="column second">
                <div>
                    <ul class="clearfix">
                        <li>
                            <a href="#">Log In</a>
                        </li>
                        <li>
                            <a href="#">More Info</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <p>Logged in as: Noob Face 01</p>
                </div>
            </div>
        </div>
    </div>
<div id="site_container">
    <div id="content_container">
        <div class="columns blog_two clearfix">
            
            <div class="column first">
                <?php echo View::factory(Page::core_template())."\n"; ?>
            </div>

            <div class="column second">
                <?php echo View::factory( 'advertisements/sidebar' )."\n"; ?>
            </div>
        </div>
    </div>

    <div id="footer_container">
        <p> &copy; 2007-2011 Ultri Group LLC - All Rights Reserved </p>
    </div>
</div>
<?php
    echo View::factory('html/close')->render();
?>