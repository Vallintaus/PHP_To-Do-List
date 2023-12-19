<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use ToDoList\ToDoList;


$todoList = new ToDoList(isset($_SESSION['tasks']) ? $_SESSION['tasks'] : []);


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskName'])) {
    // Get the task name from the form
    $taskName = trim($_POST['taskName']);

    // add the task
    $todoList->addTask($taskName);

    $_SESSION['tasks'] = $todoList->getAllTasks();

    // Here you might want to save the updated list to a session or database
    // For now, we'll just redirect back to the main page
    header('Location: index.php');
    exit();
}
