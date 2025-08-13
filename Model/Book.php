<?php

namespace Model;

use PDO;
use Model\Connection;

class Book
{
    private $conn;

    public $id;
    public $title;
    public $year_public;
    public $author;
    public $publisher;
    public $genre;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    // Método para obter todos os livros
    public function getBooks($id = null){

        if($id){
        $sql = 'SELECT * FROM books WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        } else {
            $sql =  'SELECT * FROM books';
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    // Método para criar um novo livro
    public function createBook()
    {
        $sql = "INSERT INTO books (title, year_public, author, publisher, genre)
                VALUES (:title, :year_public, :author, :publisher, :genre)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":year_public", $this->year_public, PDO::PARAM_INT);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
        $stmt->bindParam(":publisher", $this->publisher, PDO::PARAM_STR);
        $stmt->bindParam(":genre", $this->genre, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Método para atualizar um livro
    public function updateBook()
    {
        $sql = "UPDATE books SET 
                    title = :title, 
                    year_public = :year_public, 
                    author = :author, 
                    publisher = :publisher, 
                    genre = :genre
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":year_public", $this->year_public, PDO::PARAM_INT);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
        $stmt->bindParam(":publisher", $this->publisher, PDO::PARAM_STR);
        $stmt->bindParam(":genre", $this->genre, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Método para excluir um livro
    public function deleteBook()
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>
