<?php
// IMPORTAÇÃO DE ARQUIVOS
require_once __DIR__ . '/vendor/autoload.php';

use Controller\BookController;

// INSTANCIA O CONTROLLER
$bookController = new BookController();

// OBTÉM O MÉTODO HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $bookController->getBooks();
        break;
    case 'POST':
        $bookController->createBook();
        break;
    case 'PUT':
        $bookController->updateBook();
        break;
    case 'DELETE':
        $bookController->deleteBook();
        break;
    default:
        echo json_encode(["message" => "Método não permitido"]);
        break;
}
