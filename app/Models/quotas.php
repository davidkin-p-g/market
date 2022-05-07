<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotas extends Model
{
    // охраняемые атрибуты модели которые нельзя изменить
    protected $guarded = ['quotas_id','created_at', 'updated_at'];

    // поиск итемов квоты
    public function item()
    {
        return $this->hasMany(quotas_items::class, 'quotas_id');
    }


}
