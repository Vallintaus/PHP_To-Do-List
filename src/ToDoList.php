<?php

namespace ToDoList;

use PDO;


class ToDoList
{

    private $pdo;
    private $tasks = [];

    public function __construct()
    {
        $this->pdo = DbConnection::getConnection();
    }

    public function addTask($taskName)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (task) VALUES (:taskName)");
        $stmt->execute(['taskName' => $taskName]);
    }


    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    public function getAllTasks()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks ORDER BY task_id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function deleteTask($taskId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE task_id = :taskId");
        $stmt->execute(['taskId' => $taskId]);
    }

    public function updateTask($id, $taskName)
    {
        $stmt = $this->pdo->prepare("UPDATE tasks SET task = :taskName WHERE task_id = :id");
        $stmt->execute(['taskName' => $taskName, 'id' => $id]);
    }

    public function MarkTaskCompleted($taskId)
    {
        $query = "UPDATE tasks SET completed = 1 WHERE task_id = :taskId";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute(['taskId' => $taskId]);
    }


    public function isTaskCompleted($taskname)
    {
        foreach ($this->tasks as $task) {
            if ($task['name'] === $taskname && $task['completed']) {
                return true;
            }
        }
        return false;
    }
}
