<?php

namespace App\Services;

use App\Contracts\NoteServiceInterface;
use App\Contracts\NoteRepositoryInterface;
use Carbon\Carbon;

class NoteService implements NoteServiceInterface
{

    protected $note;

    public function __construct(
        NoteRepositoryInterface $note
    )
    {
        $this->note = $note;
    }

    public function createNote(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $noteItem = $this->storeNote($attributes);

        if($noteItem->wasRecentlyCreated === true) {
            $response['status'] = true;
            $response['message'] = 'Note successfully created.';
        }

        return $response;

    }

    private function storeNote(array $attribs) {
        $prepData = array(
            'title' => $attribs['title'],
            'note' => $attribs['note'],
            'is_deleted' => 0
        );

        return $this->note->create($prepData);
    }

    public function getNotes()
    {
        $noteItems = $this->note->all()->sortBy('create_at');

        if ($noteItems) {
            $response['status'] = true;
            $response['message'] = 'Notes fetched successfully.';
            $response['data'] = $noteItems;
        } else {
            $response['message'] = 'Notes not found.';
        }
        
        return $response;
    }

    public function show($id)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong.'
        );

        $noteItem = $this->note->find($id);

        if ($noteItem) {
            $response['status'] = true;
            $response['message'] = 'Note fetched successfully.';
            $response['data'] = $noteItem;
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

        $noteItem = $this->updateNote($id,$attributes);

        if($noteItem) {
            $response['status'] = true;
            $response['message'] = 'Note successfully updated.';
            $response['data'] = $this->note->find($id);
        }

        return $response;
    }

    private function updateNote($id, array $attribs){
        $prepData = array(
            'title' => $attribs['title'],
            'note' => $attribs['note'],
            'updated_at' => Carbon::now()
        );
        return $this->note->update($id, $prepData);
    }

    public function delete($id)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $noteItem = $this->deleteNote($id);

        if($noteItem) {
            $response['status'] = true;
            $response['message'] = 'Note successfully deleted.';
        }

        return $response;
    }

    private function deleteNote($id)
    {
        $prepData = array(
            'is_deleted' => 1,
            'updated_at' => Carbon::now()
        );

        return $this->note->update($id, $prepData);
    }

}
