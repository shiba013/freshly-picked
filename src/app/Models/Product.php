<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }

    public function scopeNameSearch($query, $name)
    {
        if (!empty($name))
        {
            $query->where('name',$name);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword))
        {
            $query->where('name', 'like', '%' . $keyword . '%');
        };
    }

    public function scopePriceSort($query, $sort)
    {
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }
    }
}
