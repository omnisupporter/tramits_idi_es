<?php

class VerificationAccess {
	//String
	public $username;
	
	//String
	public $password;
	
	//Enum (String) = [NOTAVAILABLE, ANONYMOUS, USERPASSWORD, CERTIFICATE, PRIVATE]
	public $type;
}

?>