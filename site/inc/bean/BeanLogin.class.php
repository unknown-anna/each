<?php

class BeanLogin {

	private $user_name = "";
	private $user_pass = "";


	function get_user_name() {
		return $this->user_name;
	}
	function set_user_name( $user_name ) {
		$this->user_name = $user_name;
	}


	function get_user_pass() {
		return $this->user_pass;
	}
	function set_user_pass( $user_pass ) {
		$this->user_pass = $user_pass;
	}

}