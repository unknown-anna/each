<?php

class BeanCommon{

	private $system_msg = "";
	private $debug = "";
	private $user_session = "";

	function set_system_msg( $system_msg ){
		$this->system_msg = $system_msg;
	}
	function get_system_msg(){
		return $this->system_msg;
	}


	function set_debug( $debug ){
		$this->debug = $debug;
	}
	function get_debug(){
		return $this->debug;
	}


	function set_session( $session ){
		$this->session = $session;
	}
	function get_session(){
		return $this->session;
	}


}