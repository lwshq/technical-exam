<?php

namespace App\Contracts;

interface TodoServiceInterface
{
    public function store(array $attributes);

    public function all();

    public function show($id);

    public function update($id, array $attributes);

    public function delete($id);

    public function done($id);



}