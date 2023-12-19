<?php
session_start();
require_once '../vendor/autoload.php';

use ToDoList\ToDoList;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_id']) && isset($_POST['task'])) {
    $id = $_POST['task_id'];
    $task = $_POST['task'];

    $todoList = new ToDoList();
    $todoList->updateTask($id, $task);

    echo "Task updated";
}
