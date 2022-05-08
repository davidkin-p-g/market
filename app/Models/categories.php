<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $guarded = ['id'];

    // Get children category
    public function children() {
        return $this->hasMany(self::class, 'IdParent');
    }
    // дети выложенные в доступ
    public function get_pub_children() {
        return $this->hasMany(self::class, 'IdParent')->where('Published', 1);
    }
}
