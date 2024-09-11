<?php

namespace App\Models;

use App\Exceptions\HTTPException;

class TodoModel {

    private $connection = null;

    public function __construct() {
        try {
            $this->connection = new \mysqli("localhost", "todo", "password", "todo_db");

            if ($this->connection->connect_error) {
                throw new Exception("Could not connect to database: " . $this->connection->connect_error);
            }
        } catch (Exception $e) {
            throw new HTTPException("Database connection failed: " . $e->getMessage());
        }
    }

    public function getTodos(): array {
    $result = $this->connection->query("SELECT * FROM todos ORDER BY date_time DESC");
    if (!$result) {
        throw new HTTPException($this->connection->error);
    }

    $todos = [];
    while ($row = $result->fetch_assoc()) {
        if (isset($row['description'])) {
            $todos[] = $row;
        } else {
        }
    }

    return $todos;
}


    public function getTodo($id): ?array {
        $stmt = $this->connection->prepare("SELECT * FROM todos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new HTTPException($this->connection->error);
        }

        $todo = $result->fetch_assoc();
        if (!$todo) {
            throw new NotFoundException("Todo not found.");
        }

        return $todo;
    }

    public function deleteTodos($id): void {
        $stmt = $this->connection->prepare("DELETE FROM todos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new NotFoundException("Todo not found.");
        }
    }

    public function addTodo($description): void {
    if (empty($description)) {
        throw new \InvalidArgumentException("La description du todo ne peut pas être vide.");
    }

    $date = date('Y-m-d H:i:s');
    $stmt = $this->connection->prepare("INSERT INTO todos (done, description, date_time) VALUES (FALSE, ?, ?)");
    $stmt->bind_param("ss", $description, $date);
    $stmt->execute();

    if ($stmt->error) {
        throw new HTTPException("Erreur lors de l'ajout du todo : " . $stmt->error);
    }
}

public function updateTodo($id, $description, $done): void {
    $stmt = $this->connection->prepare("UPDATE todos SET description = ?, done = ? WHERE id = ?");
    $stmt->bind_param("sii", $description, $done, $id);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new NotFoundException("Todo not found.");
    }
}
}
?>

