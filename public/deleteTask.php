<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use ToDoList\ToDoList;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    // Create ToDoList instance and delete the task
    $todoList = new ToDoList();
    $todoList->deleteTask($taskId);

    // Redirect back to the main page
    header('Location: index.php');
    exit();
}
