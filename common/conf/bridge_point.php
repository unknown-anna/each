<?php

ini_set('display_errors', '1');
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL);

require_once( "setting.php" );
require_once( DIR_SITE_BEAN."BeanCommon.class.php" );

$debug = ( !empty($_GET['debug']) ) ? $_POST['debug'] : "";


session_start ();
$action = $_GET[ 'action' ]; 
if ( $action == "index" ) { $action = "static_index"; }


$path_separator = "_";
$action_instance = explode( $path_separator, $action );
$controller_name = "Controller" . ucfirst ( $action_instance[0] );


if( file_exists( DIR_SITE_CONTROLLER . $controller_name . ".class.php" ) ) {
	require_once( DIR_SITE_CONTROLLER . $controller_name . ".class.php" );
	$contorller = new $controller_name;
	$instance = $action_instance[1];

	$bean = new BeanCommon;
	$contorller->$instance();
	
} 





