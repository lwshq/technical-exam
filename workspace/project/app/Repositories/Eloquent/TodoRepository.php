<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use App\Contracts\TodoRepositoryInterface;
use Illuminate\Support\Collection;

class TodoRepository extends BaseRepository implements TodoRepositoryInterface
{

    /**
    * TodoRepository constructor.
    *
    * @param Todo $model
    */
    public function __construct(Todo $model)
    {
       parent::__construct($model);
    }

}