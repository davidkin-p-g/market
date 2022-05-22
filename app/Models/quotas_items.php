<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function items_buyer($BuyerId,$quota_id)
    {
        $items = DB::table('quotas_items')
            ->select('quotas_items.*',
                'categories.Categories',
                DB::raw('count(DISTINCT quotas_items.id) as ItemsAll'),
                DB::raw('sum(DISTINCT quotas_items.ItemCount) as ItemsAllCount'),
                DB::raw('count(offers.id) as offers_count'),
                DB::raw('count(if(offers.PublishedDate is not null,1,null)) as offers_count_pub'),
                DB::raw('count(if(offers.PublishedDate is null,1,null)) as offers_count_notpub'),
                DB::raw('sum(offers.TotalCount) as TotalCount')
            )
            ->where('quotas_items.QuotasId', $quota_id)
            ->where('quotas_items.isDelete', 0)

            ->join('categories', 'categories.id', '=', 'quotas_items.IdCategories')

            ->leftJoin('offers', 'quotas_items.id', '=', 'offers.ItemsId')
            ->where(function($query) use ($BuyerId)
            {
                $query->where('offers.isDelete', 0)
                    ->where('offers.BuyerId',$BuyerId)
                    ->orWhereNull('offers.BuyerId');
            })

            ->groupBy('quotas_items.id')
            ->get();
        return $items;
    }

    public function items_seller($SellerId, $quota_id)
    {
        $items = DB::table('quotas_items')
            ->select('quotas_items.*',
                'categories.Categories',
                DB::raw('count(DISTINCT quotas_items.id) as ItemsAll'),
                DB::raw('sum(DISTINCT quotas_items.ItemCount) as ItemsAllCount'),
                DB::raw('count(offers.id) as offers_count'),
                DB::raw('count(if(offers.PublishedDate is not null,1,null)) as offers_count_pub'),
                DB::raw('count(if(offers.PublishedDate is null,1,null)) as offers_count_notpub'),
                DB::raw('sum(offers.TotalCount) as TotalCount')
            )
            ->where('quotas_items.QuotasId', $quota_id)
            ->where('quotas_items.isDelete', 0)

            ->join('categories', 'categories.id', '=', 'quotas_items.IdCategories')

            ->leftJoin('offers', 'quotas_items.id', '=', 'offers.ItemsId')
            ->where(function($query) use ($SellerId)
            {
                $query->where('offers.isDelete', 0)
                    ->where('offers.SellerId',$SellerId)
                    ->orWhereNull('offers.SellerId');
            })

            ->groupBy('quotas_items.id', 'ItemCount')
            ->get();
        return $items;
    }
}
