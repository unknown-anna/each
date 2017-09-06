<?php

class ControllerStatic{

	function index() {
		$session = $_SESSION;
		$session_id = session_id();
		$cookie_islogin = ( !empty($_COOKIE['each_login']) ) ? $_COOKIE['each_login'] : "" ;
		// $cookie_test = $_COOKIE[ 'each_joinlogin' ];

		if( empty( $cookie_islogin ) ) {
			$tpl = "login.php";

		} else {
			$tpl = "profile.php";

		}

		if( file_exists( DIR_SITE_TEMPLATE.$tpl ) ) {
			header('Content-Type:text/html; charset=UTF-8');
			include(DIR_SITE_TEMPLATE.$tpl);
		}


	}

}