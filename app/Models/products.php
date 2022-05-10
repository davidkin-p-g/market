<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $guarded = ['id'];

    public function products_categoties_name() {
        return $this->hasMany(categories::class, 'id', 'IdCategories')->select('id', 'Categories');
    }
}
