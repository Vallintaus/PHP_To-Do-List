<?php
session_start();

require_once '../vendor/autoload.php';

use ToDoList\DbConnection;
use ToDoList\ToDoList;



$todoList = new ToDoList(isset($_SESSION['tasks']) ? $_SESSION['tasks'] : []);
$tasks = $todoList->getAllTasks();


if (isset($_SESSION['tasks'])) {
    $todoList->setTasks($_SESSION['tasks']);
}

?>
<?php include 'header.php'; ?>


<div class="container">
    <h1 class="text-center">My TODO List</h1>
    <form action="addTask.php" method="post" class="mb-4">
        <input class="form-control mb-2" type="text" name="taskName" placeholder="Enter a task">
        <button class="btn btn-primary" type="submit">Add Task</button>
    </form>

    <ul id="taskList" class="list-unstyled">
        <?php foreach ($tasks as $task) : ?>
            <li id="task-item-<?= $task['task_id'] ?>" class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <span class="task-text" id="task-text-<?= $task['task_id'] ?>"><?= htmlspecialchars($task['task']) ?></span>
                    <input type="text" class="form-control edit-task-input" id="edit-task-<?= $task['task_id'] ?>" value="<?= htmlspecialchars($task['task']) ?>" style="display: none;">
                </div>

                <div class="btn-group" role="group">
                    <?php if (!$task['completed']) : ?>
                        <!-- Completed button -->
                        <button type="button" class="btn btn-success complete-btn mr-1" onclick="markTaskCompleted(<?= $task['task_id'] ?>)">Complete</button>
                    <?php endif; ?>

                    <!-- edit button -->
                    <button type="button" class="btn btn-info edit-btn mr-1" data-id="<?= $task['task_id'] ?>">Edit</button>

                    <!-- save button (initially hidden) -->
                    <button type="button" class="btn btn-success save-btn mr-1" data-id="<?= $task['task_id'] ?>" style="display: none;">Save</button>

                    <!-- delete button -->
                    <form action="deleteTask.php" method="post" class="ml-1">
                        <input type="hidden" name="taskId" value="<?= $task['task_id'] ?>">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>




</div>
<?php include "footer.php"; ?>