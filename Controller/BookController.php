<?php

namespace Controller;

use Model\Book;

require_once __DIR__ . '/../Config/configuration.php';

class BookController
{
    // Função para pegar todos os livros
    public function getBooks()
    {
        $book = new Book();
        $books = $book->getBooks();

        if ($books) {
            header('Content-Type: application/json', true, 200);
            echo json_encode($books);
        } else {
            header('Content-Type: application/json', true, 404);
            echo json_encode(["message" => "Nenhum livro encontrado"]);
        }
    }

    // Função para criar um livro
    public function createBook()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->title) && isset($data->year_public) && isset($data->author) && isset($data->publisher) && isset($data->genre)) {
            $book = new Book();
            $book->title = $data->title;
            $book->year_public = $data->year_public;
            $book->author = $data->author;
            $book->publisher = $data->publisher;
            $book->genre = $data->genre;

            if ($book->createBook()) {
                header('Content-Type: application/json', true, 201);
                echo json_encode(["message" => "Livro criado com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao criar livro"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Informações inválidas"]);
        }
    }

    // Função para editar um livro
    public function updateBook()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->title) && isset($data->year_public) && isset($data->author) && isset($data->publisher) && isset($data->genre)) {
            $book = new Book();
            $book->id = $data->id;
            $book->title = $data->title;
            $book->year_public = $data->year_public;
            $book->author = $data->author;
            $book->publisher = $data->publisher;
            $book->genre = $data->genre;

            if ($book->updateBook()) {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message" => "Livro atualizado com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao atualizar livro"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Informações inválidas"]);
        }
    }

    // Função para excluir um livro
    public function deleteBook()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $book = new Book();
            $book->id = $id;

            if ($book->deleteBook()) {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message" => "Livro excluído com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao excluir livro"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "ID inválido"]);
        }
    }
}
