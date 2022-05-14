<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotas extends Model
{
    // охраняемые атрибуты модели которые нельзя изменить
    protected $guarded = ['quotas_id','created_at', 'updated_at'];

    public function quotas_buyer(string $BuyerId)
    {
        return $this->where('BuyerId', $BuyerId)->where('isDelete',0)->get();
    }
    public function quotas_buyer_pub(string $BuyerId)
    {
        return $this->where('BuyerId', $BuyerId)->where('isDelete',0)->where('QPublished', 'on')->get();
    }

    // не удаленные квоты
    public function quotas_not_delete()
    {
        return $this->where('isDelete',0)->get();
    }
    public function quotas_seller()
    {
        return $this->where('isDelete',0)->get()->where('QPublished', 'on');
    }
    // поиск квоты по id
    public function quota_by_id($quota)
    {
        return $this->where('id', $quota)->first();
    }




}
