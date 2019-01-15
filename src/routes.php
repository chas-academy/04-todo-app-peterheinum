<?php

$router->get('', 'TodoController@get');
$router->post('todos', 'TodoController@add');
$router->patch('todos/{id}', 'TodoController@update');
$router->get('todos/{id}/delete', 'TodoController@delete');
$router->post('todos/toggle-all', 'TodoController@toggle');
$router->post('todos/clearCompleted', 'TodoController@clear');
$router->post('todos/ChangeOrder', 'TodoController@ChangeOrder');
