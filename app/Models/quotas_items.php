<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotas_items extends Model
{
    protected $guarded = ['id','created_at', 'updated_at'];

// не удаленные итемы
    public function items(int $quotas_id)
    {
        return $this->where('quotasId',$quotas_id)->where('isDelete', 0)->get();
    }
}
