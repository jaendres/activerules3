<?php
/**
 * Data Object
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Data_Object {

	// Session singleton
	protected static $instance;

	// UUID
    public static $uuid;

    // The meta type ActiveRules
    public static $meta_type;


    // Relations array
	public static $relation = array();

    // Attributes array
	public static $attribute = array();
	
    /**
	 * Instance of Object.
	 */
	public static function & instance()
	{
		if (Data_Object::$instance == NULL)
		{
			// Create a new instance
			Data_Object::$instance = new Data_Object();
		}

		return Data_Object::$instance;
	}

	/**
	 * On first Party instance creation, it creates Object.
	 */
	public function __construct()
	{
		// This part only needs to be run once
		if (Data_Object::$instance === NULL)
		{
			// Singleton instance
			Data_Object::$instance = $this;
		}
	}

    /**
     * Set Active Object data
     *
     * @param string $meta_type
     * @param string $type
     * @param integer $sequence
     * @param mixed $data string, array or multi array
     */
    public function set($meta_type, $type, $sequence, $data)
    {
        switch($meta_type)
        {
            case 'text':
            case 'media':
            case 'link':
            case 'attribute':
                self::$$meta_type[$type][$sequence] = $data;
                break;

            case 'relation':
                switch($relation)
                {
                    case 'account':
                    case 'address':
                    case 'category':
                    case 'credential':
                    case 'event':
                    case 'item':
                    case 'party':
                    case 'transaction':
                        self::$$meta_type[$type][$sequence] = $data;
                        break;
                }
                break;

            default:
                break;
        }
    }


    /**
     * Get Active Object data
     *
     * @param string $meta_type
     * @param string $type
     * @param integer $sequence
     */
    public function get($meta_type, $type, $sequence)
    {
        switch($meta_type)
        {
            case 'text':
            case 'media':
            case 'link':
            case 'attribute':
            case 'relation':
                if(isset(self::$$meta_type[$type][$sequence]))
                {
                    return self::$$meta_type[$type][$sequence];
                }
                break;

           

            default:
               break;
        }
    }

    /**
     * Store an Active Data Object
     */
    public function store($engine)
    {
        switch($engine)
        {
            // Mixed stores objects in multiple engines
            // The object is stored in  Mongo and relations are also stored in MySQL
            case 'mixed':

                break;

            case 'file':

                break;

            case 'cloudfile':

                break;

            case 'mysql':

                break;
        }
    }


} // End Party Class
