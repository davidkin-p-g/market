<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotas extends Model
{
    // охраняемые атрибуты модели которые нельзя изменить
    protected $guarded = ['quotas_id','created_at', 'updated_at'];

    // не удаленные квоты
    public function quotas()
    {
        return $this->where('isDelete',0)->get();
    }
    // поиск квоты по id
    public function quota($quota)
    {
        return $this->where('id', $quota)->first();
    }



}
