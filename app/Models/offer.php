<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class offer extends Model
{
    protected $guarded = ['id'];

    public function offers_seller($user) {
        $offers = DB::table('offers')
            ->where('offers.SellerId', $user->id)
            ->where('offers.isDelete', 0)
            ->join('quotas_items','offers.ItemsId', '=',  'quotas_items.id')
            ->join('categories  as ca','ca.id', '=','quotas_items.IdCategories')
            ->join('products','offers.ProductsId', '=',  'products.id')
            ->join('categories as c','c.id', '=','products.IdCategories' )
            ->join('quotas','quotas_items.QuotasId', '=','quotas.id' )
            ->select('offers.*',
                'quotas_items.ItemName','quotas_items.ItemCount','quotas_items.ItemCost',
                'products.ProdName','products.ProdCount','products.ProdCost','products.SellerName',
                'quotas.Name as QuotasName','quotas.Buyer', 'quotas.QRealizationDate',
                'ca.Categories as ItemCategories', 'c.Categories as ProdCategories'
            )
            ;
        return $offers;
    }
    public function offers_buyer($user) {
        $offers = DB::table('offers')
            ->where('offers.BuyerId', $user->id)
            ->where('offers.isDelete', 0)
            ->join('quotas_items','offers.ItemsId', '=',  'quotas_items.id')
            ->join('categories  as ca','ca.id', '=','quotas_items.IdCategories')
            ->join('products','offers.ProductsId', '=',  'products.id')
            ->join('categories as c','c.id', '=','products.IdCategories' )
            ->join('quotas','quotas_items.QuotasId', '=','quotas.id' )
            ->select('offers.*',
                'quotas_items.ItemName','quotas_items.ItemCount','quotas_items.ItemCost',
                'products.ProdName','products.ProdCount','products.ProdCost','products.SellerName',
                'quotas.Name as QuotasName','quotas.Buyer', 'quotas.QRealizationDate',
                'ca.Categories as ItemCategories', 'c.Categories as ProdCategories'
            )
            ;
        return $offers;
    }
}
