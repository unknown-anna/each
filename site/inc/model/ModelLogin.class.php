<?php

class ModelLogin{


	function attempt( &$bean ) {
		$pdo = "";
		$this->attempt_exec( $bean, $pdo );

	}

	private function attempt_exec( &$bean, $pdo ) {

		require_once( DIR_SITE_DAO."DaoLogin.class.php" );
		$dao = new DaoLogin;
		$dao->attempt( $bean, $pdo );

	}



}