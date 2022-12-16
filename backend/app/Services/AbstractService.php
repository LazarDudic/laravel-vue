<?php

namespace App\Services;

abstract class AbstractService
{
    protected $repository;

    public function all($order = 'asc', $field = 'created_at', $fields = '*')
    {
        return $this->repository::all($order, $field, $fields);
    }

    public function allWith($with, $order = 'asc', $field = 'created_at', $fields = '*')
    {
        return $this->repository::allWith($with, $order, $field, $fields);
    }

    public function findById($id)
    {
        return $this->repository::findById($id);
    }

    public function getByField($field, $operator, $value)
    {
        return $this->repository::getByField($field, $operator, $value);
    }

    public function getByFields(array $fields)
    {
        return $this->repository::getByFields($fields);
    }

    public function getByMany($field, $values, $method = "whereIn")
    {
        return $this->repository::getByMany($field, $values, $method);
    }

    public function findByField($field, $value)
    {
        return $this->repository::findByField($field, $value);
    }

    public function findByFields(array $fields)
    {
        return $this->repository::findByFields($fields);
    }

    public function findByIdOrFail($id)
    {
        return $this->repository::findByIdOrFail($id);
    }

    public function delete($id)
    {
        $model = $this->findByIdOrFail($id);
        return $this->repository::delete($model);
    }
}
