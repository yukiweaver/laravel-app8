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
        'type',
    ];

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    /**
     * 指定タイプのカテゴリーを取得
     * @param array $types
     * @return collection
     */
    public function getCategoryByTypes($types)
    {
        return $this->whereIn('type', $types)->get();
    }

    /**
     * 全カテゴリーを取得
     */
    public function getCategoryAll()
    {
        return $this->all();
    }
}
