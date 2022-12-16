<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryRel extends Model
{
    public $timestamps = true;
    public $table = 'categories_rel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order',
        'parent_id',
        'child_id',
    ];
}
