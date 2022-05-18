<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class quotas extends Model
{
    // охраняемые атрибуты модели которые нельзя изменить
    protected $guarded = ['quotas_id','created_at', 'updated_at'];

    public function quotas_buyer(string $BuyerId)
    {

        $quotas = DB::table('quotas')
            ->select('quotas.*',
                DB::raw('count(offers.id) as offers_count')
            )
            ->where('quotas.BuyerId', $BuyerId)
            ->where('quotas.isDelete',0)

            ->join('quotas_items', 'quotas_items.QuotasId', '=', 'quotas.id')

            ->leftJoin('offers', 'quotas_items.id', '=', 'offers.ItemsId')
            ->where(function($query) use ($BuyerId)
            {
                $query->where('offers.isDelete', 0)
                    ->where('offers.BuyerId',$BuyerId)
                    ->orWhereNull('offers.BuyerId');
            })

            ->groupBy('quotas.id')
            ->get();
        return $quotas;
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
    public function quotas_seller($SellerId)
    {
        $quotas = DB::table('quotas')
            ->select('quotas.*',
                DB::raw('count(offers.id) as offers_count')
            )
            ->where('QPublished', 'on')
            ->where('quotas.isDelete',0)

            ->join('quotas_items', 'quotas_items.QuotasId', '=', 'quotas.id')

            ->leftJoin('offers', 'quotas_items.id', '=', 'offers.ItemsId')
            ->where(function($query) use ($SellerId)
            {
                $query->where('offers.isDelete', 0)
                    ->where('offers.SellerId',$SellerId)
                    ->orWhereNull('offers.SellerId');
            })

            ->groupBy('quotas.id')
            ->get();
        return $quotas;
    }
    // поиск квоты по id
    public function quota_by_id($quota)
    {

        return $this->where('id', $quota)->first();
    }




}
