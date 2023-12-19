document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".edit-btn").forEach(function (button) {
    button.addEventListener("click", function () {
      let id = this.getAttribute("data-id");
      document.getElementById("task-text-" + id).style.display = "none";
      document.getElementById("edit-task-" + id).style.display = "block";
      this.style.display = "none";
      document.querySelector('.save-btn[data-id="' + id + '"]').style.display =
        "inline-block";
    });
  });

  document.querySelectorAll(".save-btn").forEach(function (button) {
    button.addEventListener("click", function () {
      let id = this.getAttribute("data-id");
      let updatedTask = document.getElementById("edit-task-" + id).value;

      // AJAX request to update the task
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "updateTask.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (this.status == 200) {
          document.getElementById("task-text-" + id).innerText = updatedTask;
          document.getElementById("task-text-" + id).style.display = "block";
          document.getElementById("edit-task-" + id).style.display = "none";
          document.querySelector(
            '.edit-btn[data-id="' + id + '"]'
          ).style.display = "inline-block";
          document.querySelector(
            '.save-btn[data-id="' + id + '"]'
          ).style.display = "none";
        }
      };
      xhr.send("task_id=" + id + "&task=" + encodeURIComponent(updatedTask));
    });
  });
});

function markTaskCompleted(taskId) {
  // Strike through the task text
  let taskItem = document.getElementById("task-text-" + taskId);
  taskItem.classList.add("completed-task");

  // Wait for 3 seconds before sending the AJAX request
  setTimeout(function () {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "markTaskCompleted.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.status === 200) {
        // Remove the task item from the list
        let taskItem = document.getElementById("task-item-" + taskId);
        taskItem.remove();
      }
    };
    xhr.send("taskId=" + taskId);
  }, 3000);
}
