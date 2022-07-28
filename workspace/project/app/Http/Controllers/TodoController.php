<?php

namespace App\Http\Controllers;

use App\Contracts\TodoServiceInterface;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $todo;

    public function __construct(
        TodoServiceInterface $todo
    )
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $result = $this->todo->all();

        if($result['status'] === true){
            $todos = $result['data'];
            return view('todo.index', compact("todos"));
        }
        return $this->errorResponse([], $result['message'], 400);
    }

    public function store(TodoStoreRequest $request)
    {
        $storeResult = $this->todo->store($request->validated());
        if($storeResult['status'] === true){
            return $this->successResponse([], $storeResult['message'], 201);
        }
        return $this->errorResponse([], $storeResult['message'], 400);
    }

    public function edit($id)
    {
        $result = $this->todo->show($id);

        if($result['status'] === true){
            $res = $result['data'];
            return view('todo.update', compact("res"));

        }
        return $this->errorResponse([], $result['message'], 400);
    }

    public function update($id, TodoUpdateRequest $request)
    {
        $updateResult = $this->todo->update($id, $request->validated());
        if($updateResult['status'] === true){
            return $this->successResponse($updateResult['data'], $updateResult['message'], 201);

        }
        return $this->errorResponse([], $updateResult['message'], 400);
    }

    public function delete($id)
    {
        $deleteResult = $this->todo->delete($id);
        if($deleteResult['status'] === true){
            return $this->successResponse([], $deleteResult['message'], 201);
        }
        return $this->errorResponse([], $deleteResult['message'], 400);
    }

    public function done($id)
    {
        $res = $this->todo->done($id);
        if($res['status'] === true){
            return $this->successResponse([], $res['message'], 201);
        }
        return $this->errorResponse([], $deleteResult['message'], 400);
    }

}
