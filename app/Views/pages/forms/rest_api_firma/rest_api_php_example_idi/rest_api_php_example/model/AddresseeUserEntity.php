<?php

class AddresseeUserEntity {
	//String
	public $jobCode;
	
	//String
	public $groupCode;
	
	//Enum (String) = [SIGN, APPROVAL]
	public $action;
	
	//Enum (String) = [NEW, READ, SIGNED, APPROVAL, REJECT, NO_ACTION]
	public $status;
	
	//AddresseeActionInfo
	public $actionInfo;
	
	//StampPosition
	public $stampPosition;
}

?>