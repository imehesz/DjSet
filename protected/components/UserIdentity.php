<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if( ! isset( Yii::app()->params['auth'] ) )
		{
			throw new CHttpException( '401', 'Oops, you do NOT have the right settings in place :/' );
		}

		if( ! Yii::app()->params['auth']['ips'] == '*' || ( is_array( Yii::app()->params['auth']['ips'] ) && ! in_array( $_SERVER['REMOTE_ADDR'], Yii::app()->params['auth']['ips'] ) ) )
		{
			throw new CHttpException( '401', 'Oops, your location is not supported :/' );
		}

		if(!isset(Yii::app()->params['auth']['users'][$this->username]))
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if(Yii::app()->params['auth']['users'][$this->username]!==md5( $this->password) )
		{
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			$this->errorCode=self::ERROR_NONE;
		}

		return !$this->errorCode;

	}
}
