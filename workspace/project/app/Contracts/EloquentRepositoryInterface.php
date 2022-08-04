<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
* @package Repositories
*/
interface EloquentRepositoryInterface
{
    /**
     * Get all models.
     * 
     * @param array @columns
     * @param array @relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;
    public function findByCustomWhere(array $whereAttributes): ?Model;

    /**
     * Update existing model.
     * 
     * @param int $modelId
     * @param array $attributes
     * @return bool
     */
    public function update(int $modelId, array $attributes): bool;

    /**
     * Delete model by id.
     * 
     * @param int $modelId
     * @return bool
     */
    public function delete(int $modelId): bool;


}