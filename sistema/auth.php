<?php
require_once ('../header.php');
require_once ('../function.php');

use \Firebase\JWT\JWT;

$meta = argument();

switch ($meta) {
    case 'login': login(); break;
}

function login(){
    
    $db = dbconnect();
	$POST = POST();
    $user = $POST['user'];
    $password = $POST['password'];

    $query = "SELECT idUser, user FROM bck_user_tbl WHERE user = ? AND password = ?;";
    $pre = $db->prepare($query);
    $pre->bind_param('ss', $user,$password);
    $resultado = ejecutarConsulta($pre,1);

    $respuesta =  new stdClass();

    if($resultado){

        $count = $resultado->num_rows;
        if($count>0){

            $respuesta->response = true;
            $datos = array();
    
            while ($row = $resultado->fetch_assoc()){
                array_push($datos, array(
                    "idUser" => (utf8_encode($row['idUser'])),
                    "user" => (utf8_encode($row['user']))
                ));
            }
            /* Aumentar la seguridad del token */
            /*
            $time = time();
            $token = array(
                'iat' => $time, // Tiempo que inició el token
                'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
                'datos' => $datos
            );
            */
            $secret_key = secretKey();
            $jwt = JWT::encode($datos, $secret_key);

            $respuesta->token = $jwt;

        }else{
            error('login()','validacion','intento de login fallido');
            $msg = 'Intente nuevamente usuario o contraseña incorrecta';
            $respuesta->response = false;
            $respuesta->msg = $msg;
        }

      

    }else{
        
		error('login()','mysql',$db->error);
        $msg = 'Ocurrio un error en el login';
        $respuesta->response = false;
        $respuesta->msg = $msg;

	}
    $db->close();

    $json = json_encode($respuesta);
    echo $json;	

    

}