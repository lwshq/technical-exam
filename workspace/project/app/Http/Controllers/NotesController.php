<?php

namespace App\Http\Controllers;

use App\Contracts\NoteServiceInterface;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    protected $note;

    public function __construct(
        NoteServiceInterface $note
    )
    {
        $this->note = $note;
    }

    public function index()
    {
        $result = $this->note->getNotes();

        if($result['status'] === true){
            $notes = $result['data'];
            return view('note.index', compact("notes"));
        }
        return $this->errorResponse([], $result['message'], 400);
    }

    public function store(NoteStoreRequest $request)
    {
        $storeResult = $this->note->createNote($request->validated());
        if($storeResult['status'] === true){
            return $this->successResponse([], $storeResult['message'], 201);
        }
        return $this->errorResponse([], $storeResult['message'], 400);
    }

    public function edit($id)
    {
        $result = $this->note->show($id);

        if($result['status'] === true){
            $res = $result['data'];
            return view('note.update', compact("res"));

        }
        return $this->errorResponse([], $result['message'], 400);
    }

    public function update($id, NoteUpdateRequest $request)
    {
        $updateResult = $this->note->update($id, $request->validated());
        if($updateResult['status'] === true){
            return $this->successResponse($updateResult['data'], $updateResult['message'], 201);

        }
        return $this->errorResponse([], $updateResult['message'], 400);
    }

    public function delete($id)
    {
        $deleteResult = $this->note->delete($id);
        if($deleteResult['status'] === true){
            return $this->successResponse([], $deleteResult['message'], 201);
        }
        return $this->errorResponse([], $deleteResult['message'], 400);
    }
}
