<?php

class DBsetup{
	
	private $db_driver = "";
	private $db_hostname = "";
	private $db_database = "";
	private $db_user = "";
	private $db_pass = "";
	private $db_client_charset = "";
	private $pdo_object = null;
	private $db_autocommit = true;
	private $db_err_no = "";
	private $db_err_msg = "";
	private $num_rows = "";
	private $affected_rows = "";
	
	
	
	public function __construct($arr_db_conn_info){
		
		$this->set_db_hostname($arr_db_conn_info['hostname']);
		
		$this->set_db_database($arr_db_conn_info['database']);
		$this->set_db_user($arr_db_conn_info['user']);
		$this->set_db_pass($arr_db_conn_info['pass']);
		
		$this->set_db_driver($arr_db_conn_info['driver']);
		$this->set_db_client_charset($arr_db_conn_info['client_charset']);
	}
	
	public function  __destruct(){
		// echo(__class__."class was destroyed.<br>");
	}
	
	
	public function  get_db_driver(){
		return $this->db_driver;
	}
	public  function set_db_driver($db_driver){
		$this->db_driver = $db_driver;
	}
	
	
	public function  get_db_hostname(){
		return $this->db_hostname;
	}
	public  function set_db_hostname($db_hostname){
		$this->db_hostname = $db_hostname;
	}
	
	
	public function  get_db_database(){
		return $this->db_database;
	}
	public  function set_db_database($db_database){
		$this->db_database = $db_database;
	}
	
	
	public function  get_db_user(){
		return $this->db_user;
	}
	public  function set_db_user($db_user){
		$this->db_user = $db_user;
	}

	
	public function  get_db_pass(){
		return $this->db_pass;
	}
	public  function set_db_pass($db_pass){
		$this->db_pass = $db_pass;
	}

	
	public function  get_db_client_charset(){
		return $this->db_client_charset;
	}
	public  function set_db_client_charset($db_client_charset){
		$this->db_client_charset = $db_client_charset;
	}
	
	
	public function  get_pdo_object(){
		return $this->pdo_object;
	}
	public  function set_pdo_object($pdo_object){
		$this->pdo_object = $pdo_object;
	}
	
	
	public function  get_db_autocommit(){
		return $this->db_autocommit;
	}
	public  function set_db_autocommit($db_autocommit){
		$this->db_autocommit = $db_autocommit;
	}

	
	public function  get_db_err_no(){
		return $this->db_err_no;
	}
	public  function set_db_err_no($db_err_no){
		$this->db_err_no = $db_err_no;
	}
	

	public function  get_db_err_msg(){
		return $this->db_err_msg;
	}
	public  function set_db_err_msg($db_err_msg){
		$this->db_err_msg = $db_err_msg;
	}
	
	
	public function  get_num_rows(){
		return $this->num_rows;
	}
	public  function set_num_rows($num_rows){
		$this->num_rows = $num_rows;
	}

	
	public function  get_affected_rows(){
		return $this->affected_rows;
	}
	public  function set_affected_rows($affected_rows){
		$this->affected_rows = $affected_rows;
	}
	
	
	public function connect($isAutoCommit = true, $database){
		
		try{
			$this->set_db_autocommit($isAutoCommit);
			
			if(!empty($database)){
				$this->set_db_database($database);
			}
			
			
			$conn_str = $this->get_db_driver() . ":host=" .$this->get_db_hostname() . ";dbname=" .$this->get_db_database();
			$pdo = new PDO($conn_str, $this->get_db_user(), $this->get_db_pass()); //dns, db_name, user, pass

			
			//NOTE
			//long PDO:exex(sql) other than select //return 0 if no record was affected
			//obj PDO:query(sql) select
			
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			
			
			// set client charset
			$sql = " SET NAMES '" . $this->get_db_client_charset(). "' ";
			$bool_ret = $pdo->exec( $sql );
			if($bool_ret !== 0 ) {
				$err_msg = "Client charset was not set";
				echo $err_msg;
				$this->set_db_err_msg( $err_msg );
				return false;
			}
			
			
			//auto commit / transaction
			// echo "auto commit before : ".$pdo->getAttribute(PDO::ATTR_AUTOCOMMIT)."<br>";
			if($isAutoCommit == true) {
				$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1 );
			} else {
				$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0 );
				$pdo->beginTransaction();
			}
			
		} catch (PDOException $e) {
			$err_msg = "PDOException: " . $e->getLine() . " : " . $e->getMessage();
			echo $err_msg . "<br>";
			$this->set_db_err_msg($err_msg);
			return false;
			
		} catch (Exception $e) { 
			$err_msg = "Exception : " . $e->getLine() . " : " . $e->getMessage();
			echo $err_msg . "<br>";
			$this->set_db_err_msg($err_msg);
			return false;
		}
			
		return $pdo;
	}

}
