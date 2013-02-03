<?php

abstract class Imact_Model_Adaptor_Abstract extends Imact_Base {

	//Relative to the apdator
	protected $location;

	//Used to store connections to unique locations during the lifetime of a page load
	static protected $resource;

}