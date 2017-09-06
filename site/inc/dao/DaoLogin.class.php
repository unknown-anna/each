<?php

// require_once( DIR_SITE_CONF."DBsetup.php" );
// class DaoLogin extends DBsetup {
class DaoLogin {

	function attempt( &$bean, $pdo) {
		$user_name = $bean->get_user_name();
		$user_pass = $bean->get_user_pass();

	
		$pdo = new PDO('mysql:host=localhost;dbname=eachppl','root','root');

		$select  = "";
		$select .= " SELECT ";
		$select .= " user_id ";
		$select .= " ,user_email ";
		$select .= " ,user_password ";
		$select .= " ,user_type ";
		$select .= " ,create_date ";
		$select .= " ,update_date ";

		$from  = "";
		$from .= " FROM ";
		$from .= " account_user ";

		$where  = "";
		$where .= " WHERE ";

exit();

		$sql = "";
		$sql = $select.$from.$where;

		// try {
		// 	$stmt = $pdo->prepare( $sql );
		// 	$stmt->execute();


		// } catch( PDOException $e ) {
		// 	echo "Connection failed: " . $e->getMessage();
		// }

		// return $stmt;
	}



}