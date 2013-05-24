<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract controller class for automatic templating.
 *
 * @package    ActiverRules
 * @category   Controller
 * @author     Brian Winkers
 * @copyright  (c) 2010-2011
 * @license    http://kohanaphp.com/license
 */
class Controller_Facebook extends Controller_Activerules_Fbtab
{
	public function  __construct(Kohana_Request $request)
    {
       Request::$is_ajax = TRUE;

        parent::__construct($request);

        $this->googlestore = new Googlestore(Site::conf('google.username'), Site::conf('google.pwd'));
    }

	public function action_index($key=NULL)
	{
		echo 'Izzup Menu';
	}

    public function action_imenu($tab=FALSE)
	{
		if($tab)
		{
            // Define core view
            Page::instance()->set_page_data('core_template', 'core/izzup_menu_fbtab');

            // Cache class
            $cache = new Activerules_Cache;

            // Create a cache container name used as asubdir to keep cache file separated
            $container = 'izzup_menu';

            // Craete the cahce filename
            $cache_filename = $_POST['fb_sig_page_id'].'::'.Kohana::config ($_POST['fb_sig_page_id'].'.imenu.spreadsheet_key');

            if(!$menu = $cache->read($container, $cache_filename, 432000))
            {
                $menu = array();

                // Pull data from Google Spreadsheet.
                // DO NOT CACHE the Spreadsheet calls. We cache the final object instead.

                // Menu Sections
                $menu_sections = $this->googlestore->read('izzup_menu', Kohana::config ($_POST['fb_sig_page_id'].'.imenu.spreadsheet_key').':0', FALSE);
                foreach($menu_sections AS $section)
                {
                    $alias = very_safe($section['name']);
                    $menu['sections'][$alias]['name'] = $section['name'];

                    if(!empty($section['subcat']))
                    {
                        $sub_alias = very_safe($section['subcat']);
                    }
                    else
                    {
                        $sub_alias = 0;
                    }
                    $menu['section_data'][$alias]['subcats'][$sub_alias]['name'] = $section['subcat'];
                    $menu['section_data'][$alias]['subcats'][$sub_alias]['description'] = $section['description'];
                    $menu['section_data'][$alias]['subcats'][$sub_alias]['hours'] = $section['hours'];
                }

                // Menu Items
                $menu_items = $this->googlestore->read('izzup_menu', Kohana::config ($_POST['fb_sig_page_id'].'.imenu.spreadsheet_key').':1', FALSE);

                foreach($menu_items AS $item)
                {
                    if(!empty($item['name']))
                    {
                        // Item Alias

                        $alias = very_safe($item['name']);

                        // Section Alias
                        $section_alias = very_safe($item['section']);

                        // Subcat alias if provided
                        if(!empty($item['subcat']))
                        {
                            $section_sub_alias = very_safe($item['subcat']);
                        }
                        else
                        {
                            $section_sub_alias = 0;
                        }

                       // $menu['section_data'][$section_alias]['subcats'][$section_sub_alias]['items'][$alias] = $alias;
                        $menu['section_data'][$section_alias]['subcats'][$section_sub_alias]['items'][$alias]['name'] = $item['name'];
                        $menu['section_data'][$section_alias]['subcats'][$section_sub_alias]['items'][$alias]['description'] = $item['description'];
                        $menu['section_data'][$section_alias]['subcats'][$section_sub_alias]['items'][$alias]['price'] = $item['price'];
                    }
                }

                //Page::instance()->set_core_data('menu_items', $this->googlestore->read('izzup_menu', Kohana::config ($_POST['fb_sig_page_id'].'.imenu.spreadsheet_key').':1', FALSE));

                // Specials require special processing
                $do_specials = Kohana::config ($_POST['fb_sig_page_id'].'.imenu.specials');

                if($do_specials AND $do_specials !== $_POST['fb_sig_page_id'].'.imenu.specials')
                {
                    $specials = $this->googlestore->read('izzup_menu', Kohana::config ($_POST['fb_sig_page_id'].'.imenu.spreadsheet_key').':2', FALSE);

                    foreach($specials as $special)
                    {
                        $menu['section_data']['specials']['subcats'][0]['items'][$special['date']][] = array('name' => $special['name'],
                                                                                                            'description' => $special['description'],
                                                                                                            'price' => $special['price'],
                            );
                    }
                }

                // Cache the result
                $cache->write($container, $cache_filename, $menu);
            }

            Page::instance()->set_core_data('izzup_menu', $menu);
        }
        else
        {
            Page::instance()->set_page_data('core_template', 'core/auth_fb_app');

            Page::instance()->set_core_data('app_id', '182026656300');

            Page::instance()->set_core_data('app_name', 'Izzup! Menu');

            Page::instance()->set_core_data('app_canvas_url', 'http://apps.facebook.com/izzup_menu/');
        }

	}

	/**
	 * Loads the template [View] object.
	 */
	public function before($container=FALSE)
	{
		/* ActiveRules does NOT assume a controller will only use one template for layout.
        if ($this->auto_render === TRUE)
		{
			// Load the template
			$this->template = View::factory($this->template);
		}
        */
  		return parent::before($container);
	}

} // End Controller_Imenu

