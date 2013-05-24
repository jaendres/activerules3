<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Message logging with observer-based log writing.
 *
 * [!!] This class does not support extensions, only additional writers.
 *
 * @package    Kohana
 * @category   Logging
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Activerules_Log extends Kohana_Log {

	/**
	 * Adds a message to the log. Replacement values must be passed in to be
	 * replaced using [strtr](http://php.net/strtr).
	 *
	 *     $log->add('error', 'Could not locate user: :user', array(
	 *         ':user' => $username,
	 *     ));
	 *
	 * @param   string  type of message
	 * @param   string  message body
	 * @param   array   values to replace in the message
	 * @return  $this
	 */
	public function add($type, $message, array $values = NULL)
	{
		if(in_array($type, $cv['loggable_types'], array('AUTH')))
        {
            if ($values)
            {
                // Insert the values into the message
                $message = strtr($message, $values);
            }

            // Create a new message and timestamp it
            $this->_messages[] = array
            (
                'time' => Date::formatted_time('now', self::$timestamp, self::$timezone),
                'type' => $type,
                'body' => $message,
            );

            if (self::$write_on_add)
            {
                // Write logs as they are added
                $this->write();
            }

            return $this;
        }

        return TRUE;
	}

} // End Kohana_Log
