<?php
require "vendor/autoload.php";
@session_start();

use \Firebase\JWT\JWT;

function getToken(){
    
    $key = secretKey();
    $token =  isset($_SERVER["HTTP_TOKEN"]) ? trim($_SERVER["HTTP_TOKEN"]) : '';
    $decoded = JWT::decode($token, $key, array('HS256'));

    return $decoded;
}

function secretKey(){
	 return 'BackendPHP';
}

function dbconnect(){

	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'backendphp';

	$mysql = new mysqli($host, $user, $password, $database);

	if ($mysql->connect_errno){
		error('dbconnect()','mysql',$mysql->connect_error);
    }else{
    	return $mysql;	
    }
	
}

function ejecutarConsulta($pre,$tipo,$metodo=''){
	
	$db = dbconnect();
	$r = $pre->execute();
    $result = $pre->get_result();
	if($tipo==0){

		$respuesta =  new stdClass();
		if($r){
			$respuesta->response = true;
		}else{
			error($metodo,'mysql',$db->error);
			$msg = 'Ocurrio un error intente nuevamente';
			$respuesta->response = false;
			$respuesta->msg = $msg;
		}
		$json = json_encode($respuesta);
		return $json;

	}else{
		return $result;
	}
    
	$db->close();
}	

function error($function, $type, $msg){
	$fecha = date("m.d.y");
	$file = fopen("error.log","a");
	fputs($file,$fecha.": ".$function." - ". $type ." -> ".$msg."\n");
}

function argument(){


	//Content Type para request application/json
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

	if ($contentType === "application/json" ||  $contentType === "application/json; charset=utf-8" ) {

		//Receive the RAW post data.
		$POST = POST();
		
		//If json_decode failed, the JSON is invalid.
		if(! is_array($POST)) {
		    echo '{ "Success": false, "Msg" : "JSON Invalid" }';
		    error('argument()','recibirArgumentos','JSON Invalid - No es un array');
		    exit(0);
		}else{
			$meta = $POST['option'];
		}

	}else{
		echo ' Invalid Request ...!';
		error('argument()','recibirArgumentos','Peticion invalida: '.$contentType);
		exit(0);
	}

	return $meta;

}

function POST(){
	//Receive the RAW post data.
	$content = trim(file_get_contents("php://input"));
	$POST = json_decode($content,true);
	return $POST;
}

 ?>