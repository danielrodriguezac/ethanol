<?php

namespace Ethanol;

/**
 * Defines a common interface for authentication drivers.
 * 
 * @author Steve "uru" West <uruwolf@gmail.com>
 * @license http://philsturgeon.co.uk/code/dbad-license DbaD
 */
abstract class Auth_Driver
{

	/**
	 * Asks the driver to create a new user.
	 * 
	 * @param string $email The email address of this user. This is required by all drivers.
	 * @param array $userdata An array containing various information about the user to create.
	 * @return Ethanol\Model_User The user object that was created.
	 */
	public abstract function create_user($email, $userdata);

	public abstract function activate_user($userdata);
	
	/**
	 * Attempts to find a user by email address or returns a new (unsaved) user
	 * object if not.
	 * 
	 * @param string $email
	 * @return \Ethanol\Model_User
	 */
	public static final function get_core_user($email)
	{
		$user = Model_User::find_by_email($email);
		
		if($user == null)
		{
			$user = new Model_User;
			$user->meta = new Model_User_Meta;
			$user->email = $email;
		}
		return $user;
	}

}

class NoSuchActivationKey extends \Exception {}

class UserAlreadyActivated extends \Exception {}