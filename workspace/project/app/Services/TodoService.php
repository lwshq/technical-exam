<?php

namespace App\Services;

use App\Contracts\TodoServiceInterface;
use App\Contracts\TodoRepositoryInterface;
use Carbon\Carbon;

class TodoService implements TodoServiceInterface
{

    protected $todo;

    public function __construct(
        TodoRepositoryInterface $todo
    )
    {
        $this->todo = $todo;
    }

    public function store(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $noteItem = $this->storeToDo($attributes);

        if($noteItem->wasRecentlyCreated === true) {
            $response['status'] = true;
            $response['message'] = 'To do successfully created.';
        }

        return $response;

    }

    private function storeToDo(array $attribs) {
        $prepData = array(
            'title' => $attribs['title'],
            'is_done' => 0,
            'is_deleted' => 0
        );

        return $this->todo->create($prepData);
    }

    public function all()
    {
        $todoItems = $this->todo->all()->sortBy('create_at');

        if ($todoItems) {
            $response['status'] = true;
            $response['message'] = 'To do fetched successfully.';
            $response['data'] = $todoItems;
        } else {
            $response['message'] = 'To do not found.';
        }
        
        return $response;
    }

    public function show($id)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong.'
        );

        $todoItem = $this->todo->find($id);

        if ($todoItem) {
            $response['status'] = true;
            $response['message'] = 'To do fetched successfully.';
            $response['data'] = $todoItem;
        } else {
            $response['message'] = 'Note not found.';
        }
        
        return $response;
    }

    public function update($id, array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $todoItem = $this->updateTodo($id,$attributes);

        if($todoItem) {
            $response['status'] = true;
            $response['message'] = 'To do successfully updated.';
            $response['data'] = $this->todo->find($id);
        }

        return $response;
    }

    private function updateTodo($id, array $attribs){
        $prepData = array(
            'title' => $attribs['title'],
            'updated_at' => Carbon::now()
        );
        return $this->todo->update($id, $prepData);
    }

    public function delete($id)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $todoItem = $this->deleteTodo($id);

        if($todoItem) {
            $response['status'] = true;
            $response['message'] = 'To do successfully deleted.';
        }

        return $response;
    }

    private function deleteTodo($id)
    {
        $prepData = array(
            'is_deleted' => 1,
            'updated_at' => Carbon::now()
        );

        return $this->todo->update($id, $prepData);
    }

    public function done($id)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $todoItem = $this->doneTodo($id);

        if($todoItem) {
            $response['status'] = true;
            $response['message'] = 'To do successfully mark as done.';
        }

        return $response;
    }

    private function doneTodo($id)
    {
        $prepData = array(
            'is_done' => 1,
            'updated_at' => Carbon::now()
        );

        return $this->todo->update($id, $prepData);
    }
}
