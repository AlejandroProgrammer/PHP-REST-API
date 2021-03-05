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

    $item->Rut = isset($_GET['Rut']) ? $_GET['Rut'] : die();
  
    $item->getSingleCliente();

    if($item->Nombre != null){

        $emp_arr = array(
            "Rut" =>  $item->Rut,
            "Nombre" => $item->Nombre,
            "Edad" => $item->Edad,
            "Direccion" => $item->Direccion
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Cliente no encontrado.");
    }
?>