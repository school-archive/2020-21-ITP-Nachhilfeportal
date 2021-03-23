<?php
$method = $_SERVER['REQUEST_METHOD'];

header("Content-Type: application/json");
$response = "";

switch ($_GET["type"]) {
    case 404:
        http_response_code(404);
        $response = array(
            "success" => false,
            "message" => "path not found"
        );
        break;
    default:
        http_response_code(500);
        $response = array(
            "success" => false,
            "message" => "internal server error"
        );
}

echo json_encode($response);