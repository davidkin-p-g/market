<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotas_items extends Model
{
    protected $guarded = ['id','created_at', 'updated_at'];

// не удаленные итемы
    public function items_by_quota(int $quotas_id)
    {
        return $this->where('QuotasId',$quotas_id)->where('isDelete', 0)->get();
    }

    public function quotas_item_categoties_name() {
        return $this->hasMany(categories::class, 'id', 'IdCategories')->select('id', 'Categories');
    }
}
