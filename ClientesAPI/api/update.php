<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/employees.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Clientes($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->Rut = $data->Rut;
    
    $item->Rut = $data->Rut;
    $item->Nombre = $data->Nombre;
    $item->Edad = $data->Edad;
    $item->Direccion = $data->Direccion;
    
    if($item->updateCliente()){
        echo json_encode("Cliente modificado.");
    } else{
        echo json_encode("Cliente no pudo ser modificado.");
    }
?>