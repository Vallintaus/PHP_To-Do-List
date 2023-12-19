<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';


use ToDoList\ToDoList;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    $todoList = new ToDoList();
    $result = $todoList->markTaskCompleted($taskId);
    $todoList->deleteTask($taskId);

    if ($result) {
        echo "Task marked as completed";
    } else {
        http_response_code(500);
        echo "Failed to update task";
    }
}
