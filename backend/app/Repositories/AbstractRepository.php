<?php
namespace App\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;


abstract class AbstractRepository
{
    protected static $model;

    public static function all( $order = 'asc', $column = 'created_at', $columns = '*')
    {
        return static::$model::orderBy($column, $order)->get($columns);
    }

    public static function allWith($with ,$order = 'asc', $column = 'id', $columns = '*')
    {
        return static::$model::with($with)->orderBy($column, $order)->get($columns);
    }

    public static function findById($id)
    {
        return static::$model::find($id);
    }

    public static function getByField($field, $operator, $value)
    {
        return static::$model::where($field, $operator, $value)->get();
    }

    public static function getByFields(array $fields)
    {
        return static::$model::where($fields)->get();
    }

    public static function getByMany($field, $values, $method = 'whereIn')
    {
        return static::$model::$method($field, $values)->get();
    }

    public static function findByField($field, $value)
    {
        return static::$model::where($field, $value)->first();
    }

    public static function findByFields(array $fields)
    {
        return static::$model::where($fields)->first();
    }

    public static function findByIdOrFail($id)
    {
        return static::$model::findOrFail($id);
    }

    public static function create($data)
    {
        return static::$model::create($data);
    }

    public static function update($data, $model)
    {
        return tap($model)->update($data);
    }

    public static function updateOrCreate($data, $model = null)
    {
        if ($model instanceof static::$model) {
            return self::update($data, $model);
        }
        return self::create($data);
    }

    public static function delete($model)
    {
        $model->delete();
        return $model;
    }

    public static function search($fields,$value)
    {
        return static::$model::where(function (Builder $query) use ($fields, $value) {
            foreach (Arr::wrap($fields) as $attribute) {
                $query->orWhere($attribute, 'LIKE', "%{$value}%");
            }
        })->get();
    }

}
