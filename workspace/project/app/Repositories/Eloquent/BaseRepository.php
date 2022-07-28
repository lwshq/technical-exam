<?php

namespace App\Repositories\Eloquent;

use App\Contracts\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    /**
     * 
     * @param array @columns
     * @param array @relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return  $this->model->with($relations)->get($columns);
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    
    public function findByCustomWhere(array $whereAttributes): ?Model
    {
        return $this->model->where($whereAttributes)->first();
    }

    /**
    * Update existing model.
    * 
    * @param int $modelId
    * @param array $attributes
    * @return bool
    */
    public function update(int $modelId, array $attributes): bool
    {
        $model = $this->find($modelId);

        return $model->update($attributes);
    }

   /**
    * Delete model by id.
    * 
    * @param int $modelId
    * @return bool
    */
    public function delete(int $modelId): bool
    {
        return $this->find($modelId)->delete();
    }


}