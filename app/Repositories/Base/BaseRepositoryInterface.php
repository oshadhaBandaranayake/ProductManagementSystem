<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function deleteById(int $id);
}
