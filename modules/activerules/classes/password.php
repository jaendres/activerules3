 
 <?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    Auth
 * @author     Brian Winkers
 * @copyright  (c) 2005-2009 Ultri - Brian Winkers
 */
class Password_Core {	

	/**
     * Function creates hashed password with login and password
     *
     * @param string $login
     * @param string $password
     * @return string $hashed_password 
     */
	public static function sha256( $login, $password, $binary=TRUE ){
		
		//converts the login to upper case
		$login = strtoupper($login);
		
		//Sets the first part of salt key the uppercase login address
		$salt_key = $login;
		
		//takes the leangth of string divides by 3 and adds 1
		$index = ((strlen($login) / 3) + 1);
		
		//sets variable to and integer to drop float value
		settype($index, 'integer');
	
		//loop steps through starting at 0 and adding the index 2 times
		for( $i=0; $i<=$index*2; $i+=$index)
		{
			//adds the letter of the current position to the salt key 
			$salt_key .= substr($login, $i, 1);
		}
		
		//Adds the static string to the end of the salt key
		$salt_key .= ar::get_conf(array('site', 'encryption'), 'auth_encryption_salt'); 

		// Should we return the binary verison?
		// By default we use binary to cut storage requirements in half.
		if($binary)
		{
			//Encrypts the password with the salt key using sha 256
			return hash_hmac('sha256', $password, $salt_key, TRUE);
		}
		else
		{
			return hash_hmac('sha256', $password, $salt_key);
		}
	}
} 
// End file