<?php
header("Content-Type: application/json");

require_once "config.php";
require_once "database/Database.php";
require_once "model/Book.php";
require_once "controller/BookController.php";

$db = (new Connection())->getConnection();
$controller = new BookController($db);

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
$id = $uri[1] ?? null; // /books/{id}

if ($uri[0] !== "books") {
    http_response_code(404);
    echo json_encode(["error" => "Endpoint não encontrado"]);
    exit;
}

switch ($method) {
    case "GET":
        $controller->index();
        break;

    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->store($data);
        break;

    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->update($id, $data);
        break;

    case "DELETE":
        $controller->delete($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido"]);
}
?>