<?php

namespace App\Contracts;

interface NoteServiceInterface
{

    public function createNote(array $attributes);

    public function getNotes();

    public function show($id);

    public function update($id, array $attributes);

    public function delete($id);
    
}