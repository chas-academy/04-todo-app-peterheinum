<?php

use Todo\Controller;
use Todo\Database;
use Todo\TodoItem;

class TodoController extends Controller {
    
    public function get()
    {
        $todos = TodoItem::findAll();
        return $this->view('index', ['todos' => $todos]);
    }

    public function add()
    {
        $body = filter_body();
        if($body['title'] != ""){
          $result = TodoItem::createTodo($body['title']);
          if ($result) {
            $this->redirect('/');
          }
        } else {
          $this->redirect('/');
        }        
    }

    public function update($urlParams)
    {
        $body = filter_body(); // gives you the body of the request (the "envelope" contents)
        $todoId = $urlParams['id']; // the id of the todo we're trying to update
        $completed = isset($body['status']) ? 1 : 0; // whether or not the todo has been checked or not
        $title = $body['title'];
        
        $completed == 1 ? $completed = "true" : $completed = "false";        
        $result = TodoItem::updateTodo($todoId, $title, $completed);


        if ($result) {
          $this->redirect('/');
        }   

        // TODO: Implement me!
        // This action should update a specific todo item in the todos table using the TodoItem::updateTodo method.
        // Try and figure out what parameters you need to pass to the updateTodo-method in the TodoItem model.

        // if there's a result
          // use the redirect method to send the user back to the list of todos $this->redirect('/');
        // otherwise, throw an exception or show an error message
    }

    public function delete($urlParams)
    {
      $body = filter_body();
      $todoId = $urlParams['id'];
      $result = TodoItem::deleteTodo($todoId);

      if ($result) {
        $this->redirect('/');
      }
    }

    /**
     * OPTIONAL Bonus round!
     * 
     * The two methods below are optional, feel free to try and complete them
     * if you're aiming for a higher grade.
     */
    public function toggle()
    {
      $todos = TodoItem::findAll(); //Stolen function that will coutn if there are any completed or not
      $counter = count(array_filter($todos, function($todo) { return $todo['completed'] === "false"; }));
      if($counter > 0){
        $result = TodoItem::toggleTodos("true");        
      } else {
        $result = TodoItem::toggleTodos("false");
      }

      
      if ($result) {
        $this->redirect('/');
      }
      // (OPTIONAL) TODO: This action should toggle all todos to completed, or not completed.
    }
    
    public function clear()
    {
      $result = TodoItem::clearCompletedTodos();
      if ($result) {
        $this->redirect('/');
      }
      //(OPTIONAL) TODO: This action should remove all completed todos from the table.
    }
    
    public function filterCompleted(){
      $todos = TodoItem::findAllAndSortByCompleted();
      return $this->view('index', ['todos' => $todos]);
    }

    public function filterUnCompleted(){
      $todos = TodoItem::findAllAndSortByUnCompleted();
      return $this->view('index', ['todos' => $todos]);
    }

    public function searchFilter(){
      $body = filter_body();      
      $text = $body['searchtext'];

      if($text != ""){
        $filteredarray = TodoItem::searchText($text);       
        if(count($filteredarray) != 0){
          return $this->view('index', ['todos' => $filteredarray]);
        } 
      } else {
        $this->redirect('/');
      }  
    }
    



}
