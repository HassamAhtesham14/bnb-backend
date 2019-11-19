<?php

namespace App;

use App\Category;
use App\Variation;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = [
        'is_popular' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class);
    }
}
