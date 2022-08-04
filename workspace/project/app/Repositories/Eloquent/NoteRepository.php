<?php

namespace App\Repositories\Eloquent;

use App\Models\Note;
use App\Contracts\NoteRepositoryInterface;
use Illuminate\Support\Collection;

class NoteRepository extends BaseRepository implements NoteRepositoryInterface
{

    /**
    * NoteRepository constructor.
    *
    * @param Note $model
    */
    public function __construct(Note $model)
    {
       parent::__construct($model);
    }

}