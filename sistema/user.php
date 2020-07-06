<?php
require_once ('../header.php');
require_once ('../function.php');

$meta = argument();

switch ($meta) {
    case 'listarUsuarios': listarUsuarios(); break;
}

function listarUsuarios(){

    $db = dbconnect(); //DB
    $POST = POST();

    $query = "SELECT idUser, user FROM bck_user_tbl;";
    $pre = $db->prepare($query);
    //$pre->bind_param('ss', $user,$password);
    $resultado = ejecutarConsulta($pre,1); // 1 Regresar información SELECT -  0 No regresa informacion INSERT / UPDATE
    
    $respuesta =  new stdClass();

    if($resultado){
        // OK
        $respuesta->response = true;

            $datos = array();
    
            while ($row = $resultado->fetch_assoc()){
                array_push($datos, array(
                    "idUser" => (utf8_encode($row['idUser'])),
                    "user" => (utf8_encode($row['user']))
                ));
            }
            $respuesta->usuarios = $datos;

    }else{
        // Error
        error('listarUsaurios()','mysql',$db->error); // error.log 
        $msg = 'Ocurrio un error en listar los usuarios';
        $respuesta->response = false;
        $respuesta->msg = $msg;
    }

    $db->close();

    $json = json_encode($respuesta);
    echo $json;
    


}


?>
