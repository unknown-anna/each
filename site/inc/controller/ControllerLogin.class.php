<?php


class ControllerLogin{

	function index() {
	}

	function attempt() {

		$u_name = $_POST[ 'u_name' ];
		$u_pass = $_POST[ 'u_pass' ];
		$session_id = $_POST[ 'session_id' ];


		$result_attempt = array();
		if ( $u_name == "admin" && $u_pass == "admin" ) {
			
			require_once( DIR_SITE_BEAN."BeanLogin.class.php" );
			$bean = new BeanLogin;
			$bean->set_user_name( $u_name );
			$bean->set_user_pass( $u_pass );

			require_once( DIR_SITE_MODEL."ModelLogin.class.php" );
			$model = new ModelLogin;
			$model->attempt( $bean );

			$result_attempt = array(
					"u_name" => $u_name,
					"session_id" => $session_id,
					"status" => 1,
				);

			$expires_date = time() + 60 * 60 * 24 * 30 ;
			$domain = "localhost";
			setcookie( "each_login", 1, $expires_date, "/", $domain );

		} else {
			$result_attempt = array(
				"u_name" => $u_name,
				"session_id" => $session_id,
				"status" => 0,
			);
		}

		$json_data = json_encode( $result_attempt, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );

		header( 'Content-Type:text/html; charset=UTF-8' );
		// return $json_data;
		echo $json_data;

	}

}