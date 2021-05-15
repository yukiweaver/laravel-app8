<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'img',
    ];

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    /**
     * 全件取得
     */
    public function getCategoryAll()
    {
        return $this->all();
    }
}
