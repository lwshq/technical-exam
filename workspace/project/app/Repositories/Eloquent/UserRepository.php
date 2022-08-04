<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
    * UserRepository constructor.
    *
    * @param User $model
    */
    public function __construct(User $model)
    {
       parent::__construct($model);
    }

}