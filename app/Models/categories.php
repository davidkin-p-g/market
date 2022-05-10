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

//не работает
    public static function get_children_id($IdCategories, array $ch_id) {
        $children = categories::where('IdParent', $IdCategories)->get();

        foreach ($children as $ch)
        {
            $ch_id = categories::get_children_id($ch->id, $ch_id);
        }
        array_push($ch_id, $IdCategories );
        return $ch_id;
    }
}
