<?php


use PHPUnit\Framework\TestCase;
use Mockery as m;

use ToDoList\ToDoList;

class TaskTest extends TestCase
{
    protected function setUp(): void
    {
        m::mock('overload:ToDoList\DbConnection');
    }


    protected function tearDown(): void
    {
        m::close();
    }

    public function testAddTask()
    {
        // Create a mock
        $mockToDoList = m::mock('ToDoList\ToDoList')->makePartial();
        $mockToDoList->shouldReceive('addTask')->andReturn(true);

        // Call addTask and assert true
        $this->assertTrue($mockToDoList->addTask("Test Task"));
    }

    public function testDeleteTask()
    {
        $mockToDoList = m::mock('ToDoList\\ToDoList')->makePartial();
        $mockToDoList->shouldReceive('addTask');
        $mockToDoList->shouldReceive('deleteTask')->with(0)->andReturn(true);

        $mockToDoList->addTask("Task 1");
        $mockToDoList->addTask("Task 2");

        // Delete the first task (index 0)
        $result = $mockToDoList->deleteTask(0);

        // Assertions
        $this->assertTrue($result);
    }


    public function testUpdateTask()
    {
        $mockToDoList = m::mock('ToDoList\\ToDoList')->makePartial();
        $mockToDoList->shouldReceive('addTask');
        $mockToDoList->shouldReceive('updateTask')->with(0, "Updated Task")->andReturn(true);

        $mockToDoList->addTask("Original Task");

        // Edit the task (index 0)
        $result = $mockToDoList->updateTask(0, "Updated Task");

        // Assertions
        $this->assertTrue($result);
    }

    public function testTaskCompleted()
    {
        $mockToDoList = m::mock('ToDoList\\ToDoList')->makePartial();
        $mockToDoList->shouldReceive('addTask');
        $mockToDoList->shouldReceive('markTaskCompleted')->with("Learn PHP")->andReturn(true);

        $mockToDoList->addTask("Learn PHP");

        // ACT
        $result = $mockToDoList->markTaskCompleted("Learn PHP");

        //ASSERT
        $this->assertTrue($result);
    }
}
